<div class="xc-newsletter-form pt-60 pb-60 xc-has-overlay" data-bg="{{ asset('assets/img/banner/logo.jpeg') }}">
    <div class="container">
        <div class="xc-newsletter-form__inner">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h3 class="xc-newsletter-form__title">
                        Abonnez-vous à la newsletter
                    </h3>
                    <form action="#" class="xc-newsletter-form__main">
                        <input type="email" placeholder="Entrez votre adresse e-mail">
                        <button type="submit">S'abonner</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .xc-footer-one::before { display: none; }

    .xc-footer-one__social a {
        color: #0066CC;
        border: 1px solid rgba(0, 102, 204, 0.35);
    }

    .xc-footer-one__social a:hover {
        color: #fff;
        background: linear-gradient(135deg, #0066CC 0%, #0052a3 100%);
        border-color: transparent;
    }

    .xc-footer-one__widget-title::after {
        content: '';
        display: block;
        width: 40px;
        height: 2px;
        margin-top: 8px;
        background: linear-gradient(135deg, #0066CC 0%, #0052a3 100%);
    }

    .xc-footer-one__cta a:hover,
    .xc-footer-one__nav a:hover,
    .tagcloud a:hover {
        color: #0066CC;
    }
</style>

<footer>
    <div class="xc-footer-one pt-80" style="background: linear-gradient(135deg, #0f0f0f 0%, #1a2a4a 100%); position: relative; overflow: hidden;">
        <div style="position: absolute; inset: 0; background:
            repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(0, 102, 204, 0.04) 2px, rgba(0, 102, 204, 0.04) 4px),
            repeating-linear-gradient(0deg, transparent, transparent 50px, rgba(0, 102, 204, 0.02) 50px, rgba(0, 102, 204, 0.02) 51px);
            pointer-events: none;"></div>
        <div style="position: relative; z-index: 1;">
            <div class="xc-footer-one__wrapper pb-60">
                <div class="row gutter-y-40">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="xc-footer-one__widget xc-widget-col-1">
                            <div class="xc-footer-one__logo">
                                <a href="{{ url('/') }}"><img src="{{ asset('assets/img/banner/6400254.jpg') }}" alt="{{ config('app.name') }}" width="180" loading="lazy"></a>
                            </div>
                            <p class="xc-footer-one__about">Boutique d'électroménager et d'électronique — {{ config('app.name') }}</p>
                            <div class="xc-footer-one__cta">
                                <span><a href="tel:+33123456789"><i class="icon-phone"></i>+33 1 23 45 67 89</a></span>
                                <span><a href="mailto:contact@{{ str_replace(' ', '', strtolower(config('app.name'))) }}.com"><i class="icon-mail"></i>contact@{{ str_replace(' ', '', strtolower(config('app.name'))) }}.com</a></span>
                            </div>
                            <div class="xc-footer-one__social">
                                <a href="https://facebook.com">
                                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                                    <span class="sr-only">Facebook</span>
                                </a>
                                <a href="https://twitter.com">
                                    <i class="fab fa-x-twitter" aria-hidden="true"></i>
                                    <span class="sr-only">Twitter</span>
                                </a>
                                <a href="https://pinterest.com">
                                    <i class="fab fa-pinterest-p" aria-hidden="true"></i>
                                    <span class="sr-only">Pinterest</span>
                                </a>
                                <a href="https://instagram.com">
                                    <i class="fab fa-instagram" aria-hidden="true"></i>
                                    <span class="sr-only">Instagram</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="xc-footer-one__widget xc-widget-col-2">
                            <h3 class="xc-footer-one__widget-title">Liens rapides</h3>
                            <ul class="xc-footer-one__nav">
                                <li><a href="{{ url('/about') }}">À propos</a></li>
                                <li><a href="{{ url('/produits') }}">Produits</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                                <li><a href="{{ url('/blog') }}">Actualités</a></li>
                                <li><a href="{{ url('/politique-de-confidentialite') }}">Politique de confidentialité</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3">
                        <div class="xc-footer-one__widget xc-widget-col-3">
                            <h3 class="xc-footer-one__widget-title">Catégories populaires</h3>
                            <ul class="xc-footer-one__nav">
                                <li><a href="{{ url('/produits') }}">Tous les produits</a></li>
                                <li><a href="{{ url('/panier') }}">Panier</a></li>
                                <li><a href="{{ url('/favoris') }}">Favoris</a></li>
                                <li><a href="{{ url('/about') }}">Notre histoire</a></li>
                                <li><a href="{{ url('/contact') }}">Aide client</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="xc-footer-one__widget xc-widget-col-4">
                            <h3 class="xc-footer-one__widget-title">Tags populaires</h3>
                            <div class="tagcloud tagcloud-style-2">
                                <a href="#">électroménager</a>
                                <a href="#">télévision</a>
                                <a href="#">cuisine</a>
                                <a href="#">climatisation</a>
                                <a href="#">innovation</a>
                                <a href="#">offres</a>
                                <a href="#">marques</a>
                                <a href="#">conseils</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xc-footer-one-copyright">
            <div class="container">
                <div class="xc-footer-one-copyright__wrapper">
                    <p class="xc-footer-one-copyright__text">&copy; <span class="xc-dynamic-year"></span>
                        {{ config('app.name') }}. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
