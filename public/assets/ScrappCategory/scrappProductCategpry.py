import json
import time
import re
import os
import random
from datetime import datetime
from urllib.parse import urljoin, urlparse
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.options import Options
from selenium.common.exceptions import TimeoutException, NoSuchElementException, WebDriverException
import requests

# =========================
# CONFIGURATION
# =========================
BASE_URL = "https://www.baramboupelectronics.com"
CATEGORY_URL = "https://www.baramboupelectronics.com/matelas/"
OUTPUT_FILE = "matelas_complets.json"
IMAGES_FOLDER = "images_matelas"
DRIVER_PATH = "chromedriver"  # Chemin vers votre chromedriver

# Configuration des délais (augmentés pour éviter la détection)
MIN_DELAY = 3
MAX_DELAY = 8
PAGE_LOAD_TIMEOUT = 30

# =========================
# INITIALISATION DU DRIVER
# =========================

def init_driver():
    """Initialise le driver Chrome avec des options pour éviter la détection"""
    chrome_options = Options()
    
    # Options pour éviter la détection
    chrome_options.add_argument("--disable-blink-features=AutomationControlled")
    chrome_options.add_experimental_option("excludeSwitches", ["enable-automation"])
    chrome_options.add_experimental_option('useAutomationExtension', False)
    
    # Options de navigateur réaliste
    chrome_options.add_argument("--start-maximized")
    chrome_options.add_argument("--disable-dev-shm-usage")
    chrome_options.add_argument("--no-sandbox")
    chrome_options.add_argument("--disable-gpu")
    
    # User-Agent réaliste
    chrome_options.add_argument("user-agent=Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36")
    
    # Désactiver les logs
    chrome_options.add_argument("--log-level=3")
    chrome_options.add_argument("--silent")
    
    # Option pour cacher l'automation
    chrome_options.add_argument('--disable-infobars')
    
    try:
        driver = webdriver.Chrome(options=chrome_options)
        
        # Exécuter du JavaScript pour cacher l'automation
        driver.execute_script("Object.defineProperty(navigator, 'webdriver', {get: () => undefined})")
        
        driver.set_page_load_timeout(PAGE_LOAD_TIMEOUT)
        return driver
        
    except Exception as e:
        print(f"❌ Erreur initialisation Chrome: {e}")
        print("⚠️  Vérifiez que chromedriver est installé et à jour")
        return None

def human_delay(min_seconds=MIN_DELAY, max_seconds=MAX_DELAY):
    """Délai aléatoire pour simuler un comportement humain"""
    delay = random.uniform(min_seconds, max_seconds)
    time.sleep(delay)
    return delay

def safe_scroll(driver):
    """Fait défiler la page de manière humaine"""
    try:
        # Obtenir la hauteur de la page
        scroll_height = driver.execute_script("return document.body.scrollHeight")
        current_position = 0
        scroll_increment = random.randint(200, 500)
        
        while current_position < scroll_height:
            current_position += scroll_increment
            driver.execute_script(f"window.scrollTo(0, {current_position});")
            time.sleep(random.uniform(0.5, 1.5))
            
            # Parfois faire défiler vers le haut
            if random.random() < 0.2:  # 20% de chance
                driver.execute_script(f"window.scrollTo(0, {current_position - 100});")
                time.sleep(random.uniform(0.3, 0.8))
    
    except Exception as e:
        print(f"⚠️  Erreur lors du défilement: {e}")

# =========================
# EXTRACTION DES DONNÉES
# =========================

def extract_product_links_selenium(driver):
    """Extrait les liens des produits en utilisant Selenium"""
    print(f"🔍 Accès à la page catégorie avec Selenium...")
    
    product_links = []
    
    try:
        # Accéder à la page avec délai
        print(f"   🌐 Navigation vers: {CATEGORY_URL}")
        driver.get(CATEGORY_URL)
        
        # Attendre que la page charge
        time.sleep(random.uniform(5, 10))
        
        # Faire défiler la page
        safe_scroll(driver)
        
        # Prendre un screenshot pour débogage
        driver.save_screenshot("page_categorie.png")
        print("   📸 Screenshot sauvegardé: page_categorie.png")
        
        # STRATÉGIE 1: Chercher les produits par différents sélecteurs
        selectors = [
            (By.CSS_SELECTOR, "article.product"),
            (By.CSS_SELECTOR, ".product"),
            (By.CSS_SELECTOR, ".woocommerce-loop-product"),
            (By.CSS_SELECTOR, "li.product"),
            (By.CSS_SELECTOR, "div.product"),
            (By.CSS_SELECTOR, "a[href*='/product/']"),
            (By.CSS_SELECTOR, "a[href*='/produit/']"),
            (By.CSS_SELECTOR, "h2 a"),
            (By.CSS_SELECTOR, ".product-title a")
        ]
        
        for by, selector in selectors:
            try:
                elements = driver.find_elements(by, selector)
                if elements and len(elements) > 0:
                    print(f"   ✅ Trouvé {len(elements)} éléments avec: {selector}")
                    
                    for element in elements[:20]:  # Limiter pour test
                        try:
                            # Essayer d'obtenir le lien
                            if by == By.CSS_SELECTOR and ("/product/" in selector or "/produit/" in selector):
                                url = element.get_attribute("href")
                                title = element.text or element.get_attribute("title") or ""
                            else:
                                # Chercher un lien dans l'élément
                                link_elem = element.find_element(By.TAG_NAME, "a")
                                url = link_elem.get_attribute("href")
                                title = link_elem.text or element.text or ""
                            
                            if url and ("/product/" in url or "/produit/" in url):
                                product_links.append({
                                    "titre": title.strip(),
                                    "url": url,
                                    "categorie": "cuisiniere"
                                })
                                print(f"      ➕ {title[:50]}...")
                                
                        except Exception as e:
                            continue
                    
                    if product_links:
                        break
                        
            except Exception:
                continue
        
        # STRATÉGIE 2: Si aucune méthode ne fonctionne, extraire tous les liens
        if not product_links:
            print("   🔍 Extraction alternative: recherche de tous les liens...")
            all_links = driver.find_elements(By.TAG_NAME, "a")
            
            for link in all_links:
                try:
                    url = link.get_attribute("href")
                    if url and ("/product/" in url or "/produit/" in url):
                        title = link.text or link.get_attribute("title") or ""
                        if title and len(title) > 5:
                            product_links.append({
                                "titre": title.strip(),
                                "url": url,
                                "categorie": "cuisiniere"
                            })
                except Exception:
                    continue
        
        # Supprimer les doublons
        unique_products = []
        seen_urls = set()
        
        for product in product_links:
            if product["url"] not in seen_urls:
                seen_urls.add(product["url"])
                unique_products.append(product)
        
        print(f"\n📊 Total produits trouvés: {len(unique_products)}")
        return unique_products
        
    except TimeoutException:
        print("❌ Timeout lors du chargement de la page")
        return []
    except Exception as e:
        print(f"❌ Erreur extraction liens: {e}")
        return []

def scrape_product_details_selenium(driver, product_url, product_title, product_id):
    """Scrape les détails d'un produit avec Selenium"""
    description = ""
    images = []
    
    try:
        print(f"\n   🔍 Extraction détails: {product_title[:60]}...")
        
        # Navigation vers la page produit
        driver.get(product_url)
        delay = human_delay(4, 7)
        print(f"   ⏱️  Attente de {delay:.1f}s pour le chargement")
        
        # Faire défiler pour charger le contenu
        safe_scroll(driver)
        
        # Prendre screenshot pour débogage
        screenshot_name = f"produit_{product_id}.png"
        driver.save_screenshot(screenshot_name)
        
        # =========================
        # EXTRACTION DESCRIPTION
        # =========================
        description_selectors = [
            "div.woocommerce-product-details__short-description",
            "div#tab-description",
            "div.product-short-description",
            "div.description",
            "div.entry-content",
            "div.product-description",
            "div[itemprop='description']",
            "article .post-content",
            "div.summary.entry-summary",
            ".product .summary",
            "div.product-info"
        ]
        
        for selector in description_selectors:
            try:
                element = driver.find_element(By.CSS_SELECTOR, selector)
                if element and element.text.strip():
                    description = element.text.strip()
                    print(f"   ✅ Description trouvée avec: {selector}")
                    break
            except Exception:
                continue
        
        # Si pas trouvé, chercher dans les paragraphes
        if not description:
            try:
                paragraphs = driver.find_elements(By.TAG_NAME, "p")
                desc_texts = []
                for p in paragraphs:
                    text = p.text.strip()
                    if len(text) > 50:
                        desc_texts.append(text)
                
                if desc_texts:
                    description = "\n\n".join(desc_texts[:3])
                    print(f"   ⚠️  Description extraite des paragraphes")
            except Exception:
                pass
        
        # =========================
        # EXTRACTION IMAGES
        # =========================
        image_selectors = [
            "div.woocommerce-product-gallery img",
            "figure.woocommerce-product-gallery__wrapper img",
            ".product-images img",
            ".product-gallery img",
            "#product-images img",
            "div.images img",
            ".woo-images img",
            "img.wp-post-image",
            "img.attachment-shop_single",
            "img.attachment-woocommerce_single"
        ]
        
        for selector in image_selectors:
            try:
                img_elements = driver.find_elements(By.CSS_SELECTOR, selector)
                if img_elements:
                    print(f"   📸 {len(img_elements)} image(s) trouvée(s) avec: {selector}")
                    
                    for i, img in enumerate(img_elements[:3]):  # Limiter à 3 images
                        try:
                            img_url = img.get_attribute("src") or img.get_attribute("data-src")
                            
                            if img_url:
                                # Télécharger l'image
                                if not os.path.exists(IMAGES_FOLDER):
                                    os.makedirs(IMAGES_FOLDER)
                                
                                # Nom du fichier
                                img_name = f"cuisiniere_{product_id}_{i}.jpg"
                                img_path = os.path.join(IMAGES_FOLDER, img_name)
                                
                                # Télécharger avec requests
                                try:
                                    response = requests.get(img_url, timeout=10)
                                    if response.status_code == 200:
                                        with open(img_path, 'wb') as f:
                                            f.write(response.content)
                                        images.append(img_path)
                                        print(f"      ✅ Image {i+1} téléchargée")
                                except Exception as e:
                                    print(f"      ❌ Erreur téléchargement image: {e}")
                                    
                        except Exception as e:
                            print(f"      ⚠️  Erreur image {i+1}: {e}")
                    
                    break
                    
            except Exception:
                continue
        
        print(f"   ✅ {len(images)} image(s) téléchargée(s)")
        return description, images
        
    except TimeoutException:
        print("   ❌ Timeout lors du chargement du produit")
        return description, images
    except Exception as e:
        print(f"   ❌ Erreur extraction détails: {e}")
        return description, images

# =========================
# SCRIPT PRINCIPAL
# =========================

def main():
    print("=" * 70)
    print("🚀 SCRAPER CUISINIÈRES AVEC SELENIUM")
    print("=" * 70)
    
    # Initialiser le driver
    driver = init_driver()
    if not driver:
        return
    
    try:
        # Étape 1: Extraire les liens
        print("\n📋 ÉTAPE 1: Extraction des liens produits...")
        produits_liste = extract_product_links_selenium(driver)
        
        if not produits_liste:
            print("❌ Aucun produit trouvé")
            return
        
        # Limiter pour test (commenter pour version complète)
        # produits_liste = produits_liste[:3]
        print(f"🔧 Traitement de {len(produits_liste)} produit(s)...")
        
        # Étape 2: Traiter chaque produit
        produits_complets = []
        stats = {
            "total": len(produits_liste),
            "avec_description": 0,
            "avec_images": 0,
            "echecs": 0
        }
        
        for index, produit in enumerate(produits_liste, start=1):
            print(f"\n{'='*60}")
            print(f"[{index}/{len(produits_liste)}] {produit['titre']}")
            print(f"{'='*60}")
            
            # Extraire les détails
            description, images = scrape_product_details_selenium(
                driver, 
                produit['url'], 
                produit['titre'],
                index
            )
            
            # Créer l'objet produit
            produit_complet = {
                "id": f"cuisine_{index:03d}",
                "titre": produit['titre'],
                "url": produit['url'],
                "categorie": produit['categorie'],
                "description": description,
                "images": images,
                "image_principale": images[0] if images else "",
                "date_extraction": datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            }
            
            produits_complets.append(produit_complet)
            
            # Mettre à jour les stats
            if description:
                stats["avec_description"] += 1
            if images:
                stats["avec_images"] += 1
            
            # Délai entre les produits (plus long pour éviter la détection)
            if index < len(produits_liste):
                delay = human_delay(5, 12)
                print(f"⏳ Attente de {delay:.1f}s avant le produit suivant...")
        
        # Étape 3: Sauvegarde
        print(f"\n💾 ÉTAPE 3: Sauvegarde des résultats...")
        
        with open(OUTPUT_FILE, "w", encoding="utf-8") as f:
            json.dump(produits_complets, f, ensure_ascii=False, indent=2)
        
        # Rapport
        print(f"\n{'='*70}")
        print("✅ EXTRACTION TERMINÉE")
        print(f"{'='*70}")
        print(f"📄 Fichier: {OUTPUT_FILE}")
        print(f"🖼️  Images: {IMAGES_FOLDER}/")
        print(f"\n📊 STATISTIQUES:")
        print(f"   • Produits traités: {stats['total']}")
        print(f"   • Avec description: {stats['avec_description']}")
        print(f"   • Avec images: {stats['avec_images']}")
        print(f"   • Taux succès: {(stats['avec_description']/max(stats['total'],1))*100:.1f}%")
        
    except KeyboardInterrupt:
        print("\n\n⏹️  Extraction interrompue par l'utilisateur")
    except Exception as e:
        print(f"\n❌ Erreur critique: {e}")
    finally:
        # Fermer le driver
        print("\n🛑 Fermeture du navigateur...")
        driver.quit()

# =========================
# INSTALLATION REQUISE
# =========================

def check_installation():
    """Vérifie les prérequis"""
    print("🔧 Vérification des prérequis...")
    
    requirements = [
        ("selenium", "pip install selenium"),
        ("requests", "pip install requests")
    ]
    
    missing = []
    for package, install_cmd in requirements:
        try:
            __import__(package)
            print(f"   ✅ {package} installé")
        except ImportError:
            print(f"   ❌ {package} manquant")
            missing.append(install_cmd)
    
    if missing:
        print("\n⚠️  Prérequis manquants. Exécutez:")
        for cmd in missing:
            print(f"   {cmd}")
        return False
    
    # Vérifier ChromeDriver
    try:
        from selenium.webdriver.chrome.service import Service
        service = Service(DRIVER_PATH)
        print(f"   ✅ ChromeDriver trouvé à: {DRIVER_PATH}")
    except:
        print(f"   ❌ ChromeDriver manquant ou incorrect")
        print(f"   📥 Téléchargez-le: https://chromedriver.chromium.org/")
        print(f"   💡 Placez-le dans le même dossier ou mettez à jour DRIVER_PATH")
        return False
    
    return True

# =========================
# LANCEMENT
# =========================

if __name__ == "__main__":
    print("⚠️  ATTENTION: Ce script utilise Selenium pour contourner la protection")
    print("   Assurez-vous de respecter les conditions d'utilisation du site\n")
    
    if check_installation():
        choix = input("Voulez-vous lancer l'extraction? (o/n): ").strip().lower()
        if choix in ['o', 'oui', 'y', 'yes']:
            main()
        else:
            print("❌ Extraction annulée")
    else:
        print("\n❌ Impossible de continuer sans les prérequis")