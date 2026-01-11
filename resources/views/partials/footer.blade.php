@php
    $appName = config('app.name', 'Swiftcart');
    $cleanAppName = str_replace(' ', '', strtolower($appName));
@endphp

<style>
    :root {
        --footer-bg: #0a0b10;
        --footer-accent: #0066CC;
        --footer-text: #a0a0b0;
        --footer-heading: #ffffff;
        --footer-glass: rgba(255, 255, 255, 0.03);
        --footer-glass-border: rgba(255, 255, 255, 0.08);
    }

    .premium-footer {
        background-color: var(--footer-bg);
        color: var(--footer-text);
        font-family: 'Inter', sans-serif;
        position: relative;
        overflow: hidden;
    }

    .premium-footer::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 40%;
        height: 40%;
        background: radial-gradient(circle, rgba(0, 102, 204, 0.08) 0%, transparent 70%);
        z-index: 0;
        pointer-events: none;
    }

    .footer-newsletter {
        position: relative;
        z-index: 1;
        padding: 60px 0;
        border-bottom: 1px solid var(--footer-glass-border);
    }

    .newsletter-glass {
        background: var(--footer-glass);
        backdrop-filter: blur(10px);
        border: 1px solid var(--footer-glass-border);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    }

    .newsletter-content h3 {
        color: var(--footer-heading);
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .newsletter-content p {
        color: var(--footer-text);
        margin-bottom: 0;
    }

    .newsletter-form {
        display: flex;
        gap: 12px;
        position: relative;
    }

    .newsletter-form input {
        flex: 1;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--footer-glass-border);
        border-radius: 12px;
        padding: 15px 25px;
        color: white;
        transition: all 0.3s ease;
    }

    .newsletter-form input:focus {
        border-color: var(--footer-accent);
        background: rgba(255, 255, 255, 0.08);
        box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
    }

    .newsletter-form button {
        background: linear-gradient(135deg, #0066CC 0%, #004a99 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 0 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .newsletter-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 102, 204, 0.3);
    }

    .footer-main {
        padding: 80px 0 40px;
    }

    .footer-widget-title {
        color: var(--footer-heading);
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 25px;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-widget-title::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 30px;
        height: 2px;
        background: var(--footer-accent);
        border-radius: 2px;
    }

    .footer-about p {
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .footer-contact-info {
        list-style: none;
        padding: 0;
        margin: 0 0 25px;
    }

    .footer-contact-info li {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 12px;
    }

    .footer-contact-info li i {
        color: var(--footer-accent);
        font-size: 18px;
    }

    .footer-social-links {
        display: flex;
        gap: 12px;
    }

    .social-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: var(--footer-glass);
        border: 1px solid var(--footer-glass-border);
        color: var(--footer-text);
        transition: all 0.3s ease;
    }

    .social-btn:hover {
        background: var(--footer-accent);
        color: white;
        border-color: var(--footer-accent);
        transform: translateY(-5px) rotate(8deg);
    }

    .footer-nav-list {
        list-style: none;
        padding: 0;
    }

    .footer-nav-list li {
        margin-bottom: 12px;
    }

    .footer-nav-list a {
        color: var(--footer-text);
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-nav-list a:hover {
        color: var(--footer-accent);
        transform: translateX(5px);
    }

    .tag-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .tag-pill {
        background: var(--footer-glass);
        border: 1px solid var(--footer-glass-border);
        color: var(--footer-text);
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 13px;
        transition: all 0.3s ease;
    }

    .tag-pill:hover {
        background: rgba(0, 102, 204, 0.1);
        border-color: var(--footer-accent);
        color: var(--footer-accent);
    }

    .footer-bottom {
        border-top: 1px solid var(--footer-glass-border);
        padding: 30px 0;
    }

    .copyright-text {
        font-size: 14px;
        margin: 0;
    }

    .footer-bottom-links {
        display: flex;
        gap: 25px;
        justify-content: flex-end;
    }

    .footer-bottom-links a {
        color: var(--footer-text);
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .footer-bottom-links a:hover {
        color: var(--footer-accent);
    }

    @media (max-width: 991px) {
        .newsletter-glass {
            padding: 30px;
        }
        .footer-bottom {
            text-align: center;
        }
        .footer-bottom-links {
            justify-content: center;
            margin-top: 15px;
        }
        .newsletter-form {
            flex-direction: column;
        }
        .newsletter-form button {
            padding: 15px 0;
        }
    }
</style>

<footer class="premium-footer">
    <!-- Newsletter Section -->
    <div class="footer-newsletter">
        <div class="container">
            <div class="newsletter-glass">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div class="newsletter-content">
                            <h3>Abonnez-vous à la newsletter</h3>
                            <p>Recevez nos dernières offres et actualités directement dans votre boîte mail.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form action="#" class="newsletter-form">
                            <input type="email" placeholder="votre@adresse-email.com" required>
                            <button type="submit">S'abonner maintenant</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Footer Content -->
    <div class="footer-main">
        <div class="container">
            <div class="row gutter-y-40">
                <!-- About Widget -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-about">
                        <a href="{{ url('/') }}" class="mb-4 d-inline-block">
                            <img src="{{ asset('assets/img/banner/logo.jpeg') }}" alt="{{ $appName }}" width="150" style="filter: brightness(1.1); border-radius: 8px;">
                        </a>
                        <p>Spécialiste de l'équipement informatique et des solutions technologiques. Des performances exceptionnelles et un service expert pour tous vos besoins IT.</p>
                        <ul class="footer-contact-info">
                            <li><i class="fas fa-phone-alt"></i> <a href="tel:+33123456789" class="hover-accent">+33 1 23 45 67 89</a></li>
                            <li><i class="fas fa-envelope"></i> <a href="mailto:contact@{{ $cleanAppName }}.com" class="hover-accent">contact@itholding.com</a></li>
                        </ul>
                        <div class="footer-social-links">
                            <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Navigation Widget -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h3 class="footer-widget-title">Liens Rapides</h3>
                    <ul class="footer-nav-list">
                        <li><a href="{{ url('/about') }}">Notre Histoire</a></li>
                        <li><a href="{{ url('/produits') }}">Nos Produits</a></li>
                        <li><a href="{{ url('/blog') }}">Actualités & Blog</a></li>
                        <li><a href="{{ url('/contact') }}">Nous Contacter</a></li>
                        <li><a href="{{ url('/faq') }}">FAQ / Aide</a></li>
                    </ul>
                </div>

                <!-- Categories Widget -->
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h3 class="footer-widget-title">Menu Client</h3>
                    <ul class="footer-nav-list">
                        <li><a href="{{ url('/mon-compte') }}">Mon Compte</a></li>
                        <li><a href="{{ url('/panier') }}">Mon Panier</a></li>
                        <li><a href="{{ url('/favoris') }}">Ma Liste de Envies</a></li>
                        <li><a href="{{ url('/suivi-commande') }}">Suivi de Commande</a></li>
                        <li><a href="{{ url('/mentions-legales') }}">Mentions Légales</a></li>
                    </ul>
                </div>

                <!-- Popular Tags Widget -->
                <div class="col-lg-3 col-md-6">
                    <h3 class="footer-widget-title">Tags Populaires</h3>
                    <div class="tag-pills">
                        <a href="#" class="tag-pill">Ordinateurs</a>
                        <a href="#" class="tag-pill">Laptops</a>
                        <a href="#" class="tag-pill">Serveurs</a>
                        <a href="#" class="tag-pill">Gaming</a>
                        <a href="#" class="tag-pill">Composants</a>
                        <a href="#" class="tag-pill">Périphériques</a>
                        <a href="#" class="tag-pill">Réseaux</a>
                        <a href="#" class="tag-pill">Software</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright-text">
                        &copy; {{ date('Y') }} <strong>{{ $appName }}</strong>. Conçu avec <i class="fas fa-heart text-danger"></i> pour vous.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Conditions Générales</a>
                        <a href="#">Confidentialité</a>
                        <a href="#">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
