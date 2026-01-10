<!-- /.preloader -->
<div class="xc-page-wrapper">
    <div class="xc-scrollbar_progress"></div>
    <header>
        <div class="xc-header-one" id="xc-header-sticky" style="background: #0f0f0f; min-height: 55px;">
            <div class="container">
                <div class="xc-header-one__wrapper" style="display: flex; align-items: center; justify-content: space-between; gap: 30px;">
                    <div class="xc-header-one__logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('assets/img/banner/logo.jpeg') }}" alt="logo"
                                style="width:140px; max-height:50px; height:auto; object-fit:contain; background:transparent;"></a>
                    </div>
                    <div class="xc-header-one__right" style="display: flex; align-items: center; gap: 20px; flex: 1;">
                        <div class="xc-header-one__search d-none d-xl-block" style="flex: 1;">
                            <form action="#" style="display: flex; align-items: center; gap: 8px;">
                                <input type="search" placeholder="Recherche des produits....." style="padding: 8px 12px; font-size: 13px; height: 38px; border: 1px solid #ddd; border-radius: 4px; flex: 1;">
                                <select style="padding: 8px 10px; font-size: 12px; height: 38px; border: 1px solid #ddd; border-radius: 4px;">
                                    <option value="1" selected disabled>Tous les Catégories</option>
                                    @if(isset($categories))
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->titre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <button type="submit" style="padding: 8px 16px; font-size: 12px; height: 38px; background: #0066CC; color: white; border: none; border-radius: 4px; cursor: pointer;">Rechercher</button>
                            </form>
                        </div>
                        <div class="xc-header-one__btns d-none d-lg-flex" style="gap: 15px;">
                            <div class="dropdown">
                                <a href="#" class="xc-header-one__btn dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="icon-user"></i>{{ auth()->check() ? auth()->user()->name : 'Connexion' }}
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
                            <!-- mobile drawer  -->
                            <div class="xc-header-one__hamburger d-xl-none">
                                <button type="button" class="xc-offcanvas-btn xc-header-one__btn">
                                    <i class="icon-menu"></i>Nav Bar
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- mobile drawer  -->
                    <div class="xc-header-one__hamburger d-lg-none">
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ auth()->check() ? url('/admin') : route('login') }}" class="xc-header-one__btn"
                               title="{{ auth()->check() ? 'Tableau de bord' : 'Se connecter' }}"
                               aria-label="{{ auth()->check() ? 'Ouvrir le tableau de bord' : 'Se connecter' }}">
                                    @if(auth()->check())
                                        <i class="icon-grid"></i>
                                    @else
                                        <i class="icon-user"></i>
                                    @endif
                            </a>
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
                            <button type="button" class="xc-offcanvas-btn xc-header-one__btn">
                                <i class="icon-menu"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xc-header-one__bottom d-none d-lg-block">
            <div class="container">
                <div class="xc-header-one__bottom-wrapper">
                    <div class="xc-header-one__bottom-left">
                        <div class="xc-header-one__cat">
                            <i class="icon-menu"></i>
                            <span class="xc-header-one__cat-text">Tous les categories</span>
                            <div class="xc-header-one__cat-list" style="max-height: 260px; overflow-y: auto;">
                                <ul>
                                    @if(isset($categories))
                                        @foreach ($categories->take(8) as $categorie)
                                            <li><a href="#">{{ $categorie->titre }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="xc-header-one__menu xc-main-menu">
                            <nav id="mobile-menu">
                                <ul class="ul-0">
                                    <li>
                                        <a href="{{ url('/') }}">Accueil</a>
                                    </li>
                                    <li><a href="{{ url('/about') }}">Apropos</a></li>
                                    <li><a href="{{ url('/produits') }}">Produits</a>

                                    </li>
                                    <li>
                                        <a href="{{ url('/contact') }}">Contact</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="xc-body-overlay xc-close-toggler"></div>
    <div class="xc-search-popup">
        <div class="xc-search-popup__wrap">
            <a href="#" class="xc-search-popup__close xc-close-toggler"></a>
            <div class="xc-search-popup__form">
                <form role="search" method="get" action="#">
                    <input type="search" placeholder="Search Here..." value="" name="s">
                    <button type="submit"><i class="icon-search"></i></button>
                </form>
            </div>
        </div>
    </div>
    <div class="xc-mobile-nav__wrapper">
        <div class="xc-mobile-nav__overlay xc-close-toggler"></div>
        <!-- /.mobile-nav__overlay -->
        <div class="xc-mobile-nav__content">
            <a href="#" class="xc-mobile-nav__close xc-search-popup__close xc-close-toggler"></a>
            <div class="logo-box">
                <a href="{{ url('/') }}"><img src="{{ asset('assets/img/banner/6400254.jpg') }}" width="140"
                        style="max-height:50px; height:auto; object-fit:contain; background:transparent;" alt="" /></a>
            </div>
            <!-- /.logo-box -->
            <div class="xc-mobile-nav__menu"></div>
            <!-- /.mobile-nav__container -->

            <ul class="xc-mobile-nav__contact list-unstyled">
                <li>
                    <i class="fa fa-envelope"></i>
                    <a href="mailto:needhelp@swiftcart.com">needhelp@corpai.com</a>
                </li>
                <li>
                    <i class="fa fa-phone-alt"></i>
                    <a href="tel:666-888-0000">666 888 0000</a>
                </li>
            </ul><!-- /.mobile-nav__contact -->
            <div class="xc-mobile-nav__top">
                <div class="xc-mobile-nav__social">
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-facebook-square"></a>
                    <a href="#" class="fab fa-pinterest-p"></a>
                    <a href="#" class="fab fa-instagram"></a>
                </div><!-- /.mobile-nav__social -->
            </div><!-- /.mobile-nav__top -->
        </div>
        <!-- /.mobile-nav__content -->
    </div>
    <!-- /.mobile-nav__wrapper -->
    <div class="xc-back-to-top-wrapper">
        <button id="xc_back-to-top" type="button" class="xc-back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
            </svg>
            <span class="xc-back-to-top-progress"></span>
        </button>
    </div>
