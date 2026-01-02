@extends('layouts.app')

@section('title', 'À propos')

@section('content')
    <!-- /.preloader -->
    <div class="xc-page-wrapper">
        <!-- xc-breadcrumb area start -->
        <div class="xc-breadcrumb__area base-bg">
            <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="xc-breadcrumb__content p-relative z-index-1">
                            <div class="xc-breadcrumb__list">
                                <span><a href="{{ url('/') }}">Accueil</a></span>
                                <span class="dvdr"><i class="icon-arrow-right"></i></span>
                                <span>À propos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- xc-breadcrumb area end -->

        <!-- about one start -->
        <div class="xc-about-one pt-80 pb-80">
            <div class="container">
                <div class="row gutter-y-30 align-items-center">
                    <div class="col-xl-6 col-xxl-7">
                        <div class="xc-about-one__left">
                            <div class="xc-about-one__img">
                                <img src="{{ asset('assets/img/about/first-aboutpng.png') }}" alt="about">
                            </div>
                            <div class="xc-about-one__img-2">
                                <img src="{{ asset('assets/img/about/two-about.png') }}" alt="about">
                                <img src="{{ asset('assets/img/about/panno.png') }}" alt="about">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-xxl-5">
                        <div class="xc-about-one__right">
                            <div class="xc-about-one__heading">
                                <span class="xc-about-one__subtitle">À propos de {{ config('app.name') }} </span>
                                <h3 class="xc-about-one__title">Faites vos achats en toute confiance
                                    avec {{ config('app.name') }}</h3>
                                <p class="xc-about-one__info">{{ config('app.name') }} est votre boutique dédiée à l'électroménager et l'électronique. Nous sélectionnons des produits fiables au meilleur prix et offrons un service clientèle réactif.</p>
                            </div>
                            <ul class="xc-about-one__checklist">
                                <li><i class="fas fa-check-circle"></i>Produits de qualité et garanties constructeur</li>
                                <li><i class="fas fa-check-circle"></i>Livraison rapide et service après-vente disponible</li>
                                <li><i class="fas fa-check-circle"></i>Offres régulières et politique de retour simple</li>
                            </ul>
                            <a href="{{ url('/produits') }}" class="swiftcart-btn text-uppercase">Acheter maintenant</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- about one end -->

        <!-- counter start  -->
        {{-- <div class="xc-counter-one base-bg pt-60 pb-60">
            <div class="container">
                <div class="row gutter-y-30">
                    <div class="col-lg-3 col-sm-6">
                        <div class="xc-counter-one__item">

                            <div>
                                <h3 class="xc-counter-one__count xc-count-box">
                                    <span class="xc-counter-up xc-count-number" data-stop="3070" data-speed="1500"></span>
                                </h3>
                                <p class="xc-counter-one__title">Vendeurs</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="xc-counter-one__item">

                            <div>
                                <h3 class="xc-counter-one__count xc-count-box">
                                    <span class="xc-counter-up xc-count-number" data-stop="56" data-speed="1500"></span>

                                </h3>
                                <p class="xc-counter-one__title">Catégories</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="xc-counter-one__item">
                            <div>
                                <h3 class="xc-counter-one__count xc-count-box">
                                    <span class="xc-counter-up xc-count-number" data-stop="78" data-speed="1500"></span>
                                    <span>m</span>
                                </h3>
                                <p class="xc-counter-one__title">Produits disponibles</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="xc-counter-one__item">

                            <div>
                                <h3 class="xc-counter-one__count xc-count-box">
                                    <span class="xc-counter-up xc-count-number" data-stop="86" data-speed="1500"></span>
                                    <span>m</span>
                                </h3>
                                <p class="xc-counter-one__title">Ventes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- counter end  -->

        <!-- ads start -->
        {{-- <div class="xc-ads-one">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="xc-ads-one__img w-img">
                            <a href="#"><img src="{{ asset('assets/img/banner/middle-banner-first.png') }}" alt="publicité"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- ads end -->

        {{--
            Section "seller one" désactivée — la liste des marques/mini-bannières a été retirée
            car elle n'est plus utile sur la page "À propos". Si vous souhaitez la réactiver,
            supprimez ce commentaire et restaurez le bloc original ci-dessous.

            Exemple d'alternative (affiche une seule petite bannière) :

            <div class="xc-brand-one pt-80 pb-80">
                <div class="container">
                    <div class="xc-brand-one__wrapper text-center">
                        <a href="#"><img src="{{ asset('assets/img/banner/middle-banner-first.png') }}" alt="banner" style="max-width:100%;height:auto;" /></a>
                    </div>
                </div>
            </div>

        --}}
    </div>

@endsection
