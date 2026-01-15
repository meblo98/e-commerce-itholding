<!-- /.preloader -->
<div class="xc-page-wrapper">
    <div class="xc-scrollbar_progress"></div>
    <header>
        <div class="xc-header-one" id="xc-header-sticky">
            <div class="container">
                <div class="xc-header-one__wrapper">
                    <div class="xc-header-one__logo" style="flex-shrink: 0;">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('assets/img/banner/logo.jpeg') }}" alt="logo" style="width:140px; max-height:50px; height:auto; object-fit:contain; background:transparent;">
                        </a>
                    </div>

                    <!-- Search Bar (Center) -->
                    <div class="xc-header-one__search d-none d-xl-flex">
                        <form action="#" style="width: 100%;">
                            <input type="search" placeholder="Recherche des produits.....">
                            <select>
                                <option value="1" selected disabled>Catégories</option>
                                @if(isset($categories))
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->titre }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <button type="submit">Rechercher</button>
                        </form>
                    </div>
                    
                    <div class="xc-header-one__right" style="flex-shrink: 0;">
                        <!-- User Actions (Desktop >= LG) -->
                        <div class="xc-header-one__btns d-none d-lg-flex">
                            <div class="dropdown">
                                <a href="#" class="xc-header-one__btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icon-user"></i>
                                    <span>{{ auth()->check() ? auth()->user()->name : 'Mon Compte' }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    @if(auth()->check())
                                        <li><a class="dropdown-item" href="{{ url('/admin') }}"><i class="icon-grid me-2"></i>Dashboard</a></li>
                                        <li><a class="dropdown-item" href="{{ route('commandes.index') }}"><i class="icon-file-text me-2"></i>Mes Commandes</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="icon-log-out me-2"></i>Déconnexion
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                        </li>
                                    @else
                                        <li><a class="dropdown-item" href="{{ route('login') }}">Connexion</a></li>
                                        <li><a class="dropdown-item" href="{{ route('register') }}">Inscription</a></li>
                                    @endif
                                </ul>
                            </div>

                            <a href="{{ route('panier.index') }}" class="xc-header-one__btn xc-header-one__cart">
                                <i class="icon-shopping-cart"></i>
                                @php
                                    $panierCount = 0;
                                    if (auth()->check()) {
                                        $panierCount = \App\Models\Panier::where('user_id', auth()->id())->sum('quantite');
                                    } else {
                                        $panier = session('panier', []);
                                        $panierCount = array_sum($panier);
                                    }
                                @endphp
                                @if($panierCount > 0)
                                    <span class="badge">{{ $panierCount }}</span>
                                @endif
                            </a>
                        </div>

                        <!-- Mobile Specific Actions (< LG) -->
                        <div class="d-flex d-lg-none align-items-center gap-3">
                            <a href="{{ auth()->check() ? url('/admin') : route('login') }}" class="xc-header-one__btn"
                               title="{{ auth()->check() ? 'Tableau de bord' : 'Se connecter' }}">
                                <i class="{{ auth()->check() ? 'icon-grid' : 'icon-user' }}"></i>
                            </a>
                            <a href="{{ route('panier.index') }}" class="xc-header-one__btn xc-header-one__cart">
                                <i class="icon-shopping-cart"></i>
                                @if(isset($panierCount) && $panierCount > 0)
                                    <span class="badge">{{ $panierCount }}</span>
                                @endif
                            </a>
                        </div>

                        <!-- Universal Mobile Toggle (< XL) -->
                        <div class="xc-header-one__hamburger d-xl-none">
                            <button type="button" class="xc-offcanvas-btn xc-header-one__btn">
                                <i class="icon-menu"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Bar -->
        <div class="xc-header-one__bottom d-none d-lg-block">
            <div class="container">
                <div class="xc-header-one__bottom-wrapper d-flex align-items-center">
                    <div class="xc-header-one__bottom-left d-flex align-items-center w-100">
                        <!-- Categories Dropdown -->
                        <div class="xc-header-one__cat">
                            <i class="icon-menu me-2"></i>
                            <span class="xc-header-one__cat-text">Catégories</span>
                            <div class="xc-header-one__cat-list">
                                <ul>
                                    @if(isset($categories))
                                        @foreach ($categories->take(10) as $categorie)
                                            <li><a href="#">{{ $categorie->titre }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <!-- Main Menu -->
                        <div class="xc-header-one__menu xc-main-menu flex-grow-1">
                            <nav id="mobile-menu">
                                <ul class="ul-0 d-flex justify-content-center">
                                    <li><a href="{{ url('/') }}">Accueil</a></li>
                                    <li><a href="{{ url('/about') }}">À propos</a></li>
                                    <li><a href="{{ url('/produits') }}">Produits</a></li>
                                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="xc-body-overlay xc-close-toggler"></div>

    <!-- Mobile Nav Wrapper -->
    <div class="xc-mobile-nav__wrapper">
        <div class="xc-mobile-nav__overlay xc-close-toggler"></div>
        <div class="xc-mobile-nav__content">
            <a href="#" class="xc-mobile-nav__close xc-close-toggler">
                <i class="fa fa-times"></i>
            </a>
            <div class="logo-box">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/img/banner/logo.jpeg') }}" width="140" alt="logo" style="max-height:50px; height:auto; object-fit:contain;"/>
                </a>
            </div>
            
            <div class="xc-mobile-nav__menu"></div>

            <ul class="xc-mobile-nav__contact list-unstyled mt-4">
                <li>
                    <i class="fa fa-envelope me-2"></i>
                    <a href="mailto:contact@itholding.com">contact@itholding.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt me-2"></i>
                    <a href="tel:+1234567890">+123 456 7890</a>
                </li>
            </ul>

            <div class="xc-mobile-nav__social mt-3">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-instagram"></a>
                <a href="#" class="fab fa-linkedin-in"></a>
            </div>
        </div>
    </div>

    <!-- Back to top -->
    <div class="xc-back-to-top-wrapper">
        <button id="xc_back-to-top" type="button" class="xc-back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span class="xc-back-to-top-progress"></span>
        </button>
    </div>
</div>
