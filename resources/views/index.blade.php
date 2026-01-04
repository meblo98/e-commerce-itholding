@extends('layouts.app')

@section('title', 'Page d\'accueil')

@section('content')

    {{-- importer la bannier --}}
    @include('partials.banner')
    <!-- banner one end -->
    <!--  best deal start -->
    <div class="xc-best-deal pb-80">
        <div class="container">
            <div class="xc-best-deal__header-wraper">
                <div class="xc-sec-heading">
                    <h3 class="xc-sec-heading__title"><span><i class="icon-power"></i></span>Meilleures Offres</h3>
                </div>
                {{-- <div class="xc-best-deal__countdown" data-countdown data-date="Nov 31 2025 20:20:22">
                    <div class="xc-best-deal__countdown-inner">
                        <p>Deals ends in</p>
                        <ul>
                            <li><span data-days>0</span> Days :</li>
                            <li><span data-hours>0</span> Hrs :</li>
                            <li><span data-minutes>0</span> Min :</li>
                            <li><span data-seconds>0</span> Sec</li>
                        </ul>
                    </div>
                </div> --}}
            </div>
            <div class="xc-best-deal__filter-box tabs-box">
                <div class="xc-best-deal__filter-box-wrap">
                    <ul class="xc-best-deal__filter-btn tab-buttons">
                        <li data-tab="#all" class="tab-btn active-btn"><span>Matériels de Qualité</span>
                        </li>
                    </ul>
                    <div>
                        <a href="{{ url('/produits') }}" class="xc-view-all-link">Voir tout <i class="icon-arrow-right-long"></i></a>
                    </div>
                </div>
                <div class="xc-product-man-woman__wrapper tabs-content bg-white">
                    <div class="tab active-tab" id="all">
                        <div class="row gutter-y-20 row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5">
                            @forelse($bestOffers as $produit)
                                <div class="col">
                                    <div class="xc-product-two__item">
                                        <span class="xc-product-two__deal d-none">BEST DEALS</span>
                                        <div class="xc-product-two__img">
                                            <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" loading="lazy">
                                        </div>
                                        <h3 class="xc-product-two__title">
                                            <a href="#">{{ $produit->nom }}</a>
                                        </h3>
                                        <h4 class="xc-product-two__price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</h4>
                                        <div class="xc-product-two__btn">
                                            <a href="{{ url('/produit/'.$produit->id) }}"><i class="icon-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center">Aucun produit à afficher pour le moment.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  best deal end -->

    <!-- feature one start -->
    <div class="xc-features-one">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-xl-3 col-md-6">
                    <div class="xc-feature-one__item">
                        <div class="xc-feature-one__icon">
                            <i class="icon-box"></i>
                        </div>
                        <div class="xc-feature-one__content">
                            <h3 class="xc-feature-one__title">Materiels de Qualité</h3>
                            <p class="xc-feature-one__info">Avec des produits durables</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="xc-feature-one__item">
                        <div class="xc-feature-one__icon">
                            <i class="icon-clock"></i>
                        </div>
                        <div class="xc-feature-one__content">
                            <h3 class="xc-feature-one__title">Livraison rapide</h3>
                            <p class="xc-feature-one__info">Livraison en 24H</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="xc-feature-one__item">
                        <div class="xc-feature-one__icon">
                            <i class="icon-credit-card"></i>
                        </div>
                        <div class="xc-feature-one__content">
                            <h3 class="xc-feature-one__title">Service après-vente</h3>
                            <p class="xc-feature-one__info">Votre argent est en sécurité</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="xc-feature-one__item">
                        <div class="xc-feature-one__icon">
                            <i class="icon-support"></i>
                        </div>
                        <div class="xc-feature-one__content">
                            <h3 class="xc-feature-one__title">Support 24/7</h3>
                            <p class="xc-feature-one__info">Support en direct 24/7</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- feature one end -->

    <!--  best deal start -->
    <div class="xc-best-deal pt-80 pb-80">
        <div class="container">
            <div class="xc-sec-heading">
                <h3 class="xc-sec-heading__title"><span><i class="icon-power"></i></span>Categories</h3>
            </div>
            <div class="xc-best-deal__filter-box tabs-box">
                @isset($categoriesThree)
                    <div class="xc-best-deal__filter-box-wrap">
                        {{-- Boutons des catégories --}}
                        <ul class="xc-best-deal__filter-btn tab-buttons">
                            @foreach ($categoriesThree as $index => $categorie)
                                <li data-tab="#tab-{{ $categorie->id }}" class="tab-btn {{ $index === 0 ? 'active-btn' : '' }}">
                                    <span>{{ $categorie->titre }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div>
                            <a href="{{ url('/produits') }}" class="xc-view-all-link">Voir tout <i class="icon-arrow-right-long"></i></a>
                        </div>
                    </div>

                    {{-- Contenu des produits par catégorie --}}
                    <div class="xc-product-man-woman__wrapper tabs-content bg-white">
                        @foreach ($categoriesThree as $index => $categorie)
                            <div class="tab {{ $index === 0 ? 'active-tab' : '' }}" id="tab-{{ $categorie->id }}">
                                <div class="row gutter-y-20 row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5">
                                    @forelse($categorie->produits as $produit)
                                        <div class="col">
                                            <div class="xc-product-two__item">
                                                <span class="xc-product-two__deal d-none">BEST DEALS</span>
                                                <div class="xc-product-two__img">
                                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" loading="lazy">
                                                </div>
                                                <h3 class="xc-product-two__title">
                                                    <a href="#">{{ $produit->nom }}</a>
                                                </h3>
                                                <div class="xc-product-two__btn">
                                                    <a href="{{ url('/produit/'.$produit->id) }}"><i class="icon-eye"></i></a>
                                                    {{-- <a href="#" onclick="event.preventDefault(); this.nextElementSibling.submit();">
                                                        <i class="icon-shopping-cart"></i>
                                                    </a> --}}
                                                    <form action="{{ route('panier.add', $produit->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center">Aucun produit trouvé pour cette catégorie.</p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endisset

            </div>
        </div>
    </div>
    <!--  best deal end -->

    <!-- banner three start include from partials.middle-banner  -->
    {{-- @include('partials.middle-banner') --}}
    <!-- bammer three end -->

    <!--  Digital & Electronics: liste de produits sans onglets -->
    <div class="xc-best-deal pt-80 pb-80">
        <div class="container">
            <div class="xc-sec-heading xc-has-btn">
                <h3 class="xc-sec-heading__title"><span><i class="icon-power"></i></span>Digital & Electronics</h3>
                <div class="xc-sec-heading__btn">
                    <a href="{{ url('/produits') }}" class="xc-view-all-link">Voir tout <i class="icon-arrow-right-long"></i></a>
                </div>
            </div>

            <div class="bg-white">
                <div class="row gutter-y-20 row-cols-1 row-cols-sm-2 row-cols-lg-4 row-cols-xl-5">
                    @forelse($produitsAll as $produit)
                        <div class="col">
                            <div class="xc-product-two__item">
                                {{-- <span class="xc-product-two__deal d-none">BEST DEALS</span> --}}
                                <div class="xc-product-two__img">
                                    <img src="{{ asset('storage/' . $produit->image) }}" alt="{{ $produit->nom }}" loading="lazy">
                                </div>
                                <h3 class="xc-product-two__title">
                                    <a href="#">{{ $produit->nom }}</a>
                                </h3>
                                <h4 class="xc-product-two__price">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</h4>
                                <div class="xc-product-two__btn">
                                    <a href="{{ url('/produit/'.$produit->id) }}"><i class="icon-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Aucun produit à afficher pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!--  Digital & Electronics end -->

    <!-- ads start -->
    <div class="xc-ads-one">
        <div class="container">
            <div class="row">
                <div class="col-12">
                        <div class="xc-ads-one__img w-img">
                            <a href="#"><img src="{{ asset('assets/img/banner/6400254.jpg') }}" alt="ads"></a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ads end -->

    <!-- seller one start  -->
    <div class="xc-brand-one pt-80 pb-80">
        <div class="container">
            <div class="xc-sec-heading xc-has-btn">
                <h3 class="xc-sec-heading__title"><span><i class="icon-power"></i></span>Top Marques</h3>
                <div class="xc-sec-heading__btn">
                    <a href="{{ url('/produits') }}" class="xc-view-all-link">Voir tout <i class="icon-arrow-right-long"></i></a>
                </div>
            </div>
            <div class="xc-brand-one__wrapper">
                <div class="row gutter-y-20">
                    {{-- pour les marques --}}
                    @if(isset($marques) && $marques->count() > 0)
                        @foreach($marques as $marque)
                            <div class="col-sm-6 col-md-3 col-xl-2">
                                <div class="xc-brand-one__item">
                                    <img class="brand-logo" src="{{ asset('storage/' . $marque->logo) }}" alt="{{ $marque->nom }}" loading="lazy">
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        </div>

    <style>
        /* =========================== ANIMATIONS KEYFRAMES =========================== */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatingGold {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes rotate360 {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* =========================== PATTERN BACKGROUND =========================== */
        .xc-best-deal {
            position: relative;
            background:
                repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(0, 102, 204, 0.012) 35px, rgba(0, 102, 204, 0.012) 70px),
                repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(0, 102, 204, 0.008) 35px, rgba(0, 102, 204, 0.008) 70px);
        }

        .xc-best-deal::after {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 15% 20%, rgba(0, 102, 204, 0.08) 0, transparent 35%),
                radial-gradient(circle at 85% 10%, rgba(0, 102, 204, 0.09) 0, transparent 30%),
                radial-gradient(circle at 70% 80%, rgba(0, 102, 204, 0.07) 0, transparent 40%);
            pointer-events: none;
        }

        .xc-features-one {
            position: relative;
            background: linear-gradient(135deg, rgba(0, 102, 204, 0.05) 0%, rgba(26, 26, 26, 0.015) 100%);
            overflow: hidden;
        }

        /* Pattern géométrique subtle */
        .xc-features-one::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(0, 102, 204, 0.06) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(0, 102, 204, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        /* =========================== SECTION TITLES =========================== */
        .xc-sec-heading__title {
            animation: slideInUp 0.8s ease-out;
            position: relative;
        }

        .xc-sec-heading__title span {
            animation: floatingGold 3s ease-in-out infinite;
            display: inline-block;
        }

        /* =========================== PRODUCT CARDS =========================== */
        .xc-product-two__item {
            animation: slideInUp 0.6s ease-out backwards;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .xc-product-two__item:nth-child(1) { animation-delay: 0.1s; }
        .xc-product-two__item:nth-child(2) { animation-delay: 0.2s; }
        .xc-product-two__item:nth-child(3) { animation-delay: 0.3s; }
        .xc-product-two__item:nth-child(4) { animation-delay: 0.4s; }
        .xc-product-two__item:nth-child(5) { animation-delay: 0.5s; }

        .xc-product-two__item:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0, 102, 204, 0.18);
        }

        /* Pattern sur les cartes produits */
        .xc-product-two__item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 102, 204, 0.16), transparent);
            transition: left 0.5s ease;
            pointer-events: none;
        }

        .xc-product-two__item:hover::before {
            left: 100%;
        }

        /* Images des cartes uniformisées sur toute la page */
        .xc-product-two__img,
        .xc-product-three__img {
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5f7fb 0%, #e8f0f8 100%);
            position: relative;
        }

        .xc-product-two__img::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                repeating-linear-gradient(0deg, rgba(0, 102, 204, 0.006) 0px, rgba(0, 102, 204, 0.006) 2px, transparent 2px, transparent 4px),
                repeating-linear-gradient(90deg, rgba(0, 102, 204, 0.006) 0px, rgba(0, 102, 204, 0.006) 2px, transparent 2px, transparent 4px);
            pointer-events: none;
        }

        .dark .xc-product-two__img,
        .dark .xc-product-three__img {
            background: linear-gradient(135deg, #0f172a 0%, #1a2237 100%);
        }

        .xc-product-two__img img,
        .xc-product-three__img img {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .xc-product-two__item:hover .xc-product-two__img img {
            transform: scale(1.08);
        }

        /* Cartes marques alignées avec cartes produits */
        .xc-brand-one__item {
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, #ffffff 0%, #f9f9f9 100%);
            padding: 12px;
            box-shadow: 0 4px 16px rgba(17, 24, 39, 0.08);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
            position: relative;
            animation: slideInUp 0.6s ease-out backwards;
        }

        .xc-brand-one__item::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(0, 102, 204, 0.02) 10px, rgba(0, 102, 204, 0.02) 20px);
            pointer-events: none;
        }

        .xc-brand-one__item:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 32px rgba(0, 102, 204, 0.22);
            background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
        }

        .dark .xc-brand-one__item {
            background: linear-gradient(135deg, #111827 0%, #1a1f2e 100%);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(0, 102, 204, 0.12);
        }

        .dark .xc-brand-one__item:hover {
            border: 1px solid rgba(0, 102, 204, 0.3);
            box-shadow: 0 12px 32px rgba(0, 102, 204, 0.15);
        }

        .xc-brand-one__item .brand-logo {
            max-width: 100%;
            max-height: 140px;
            object-fit: contain;
            transition: transform 0.4s ease;
        }

        .xc-brand-one__item:hover .brand-logo {
            transform: scale(1.1);
        }

        /* Bouton panier sur les cartes produit */
        .xc-product-two__cart-btn {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 0;
            font-size: inherit;
        }

        .xc-product-two__cart-btn:hover {
            color: #0066CC;
        }

        /* Amélioration des boutons "Voir tout" */
        .xc-best-deal__btn,
        .xc-sec-heading-btn {
            background: linear-gradient(135deg, #0066CC 0%, #1A1A1A 100%) !important;
            color: white !important;
            padding: 12px 28px !important;
            border-radius: 8px !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .xc-best-deal__btn::before,
        .xc-sec-heading-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .xc-best-deal__btn:hover::before,
        .xc-sec-heading-btn:hover::before {
            width: 300px;
            height: 300px;
        }

        .xc-best-deal__btn:hover,
        .xc-sec-heading-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.4);
        }

        /* Amélioration des boutons d'action sur les cartes produits */
        .xc-product-two__btn a {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0066CC 0%, #0052a3 100%);
            color: #FFFFFF !important;
            border-radius: 50%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.3);
            margin: 0 5px;
            position: relative;
            overflow: hidden;
        }

        .xc-product-two__btn a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(28, 28, 28, 0.2);
            transition: left 0.3s ease;
        }

        .xc-product-two__btn a:hover {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.5);
        }

        .xc-product-two__btn a:hover::before {
            left: 100%;
        }

        .xc-product-two__btn a i {
            font-size: 18px;
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .xc-product-two__btn a:hover i {
            animation: rotate360 0.6s ease;
        }

        /* Style pour les liens "Voir tout" sans background */
        .xc-view-all-link {
            color: #0066CC !important;
            font-weight: 600;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            position: relative;
        }

        .xc-view-all-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #0066CC;
            transition: width 0.3s ease;
        }

        .xc-view-all-link:hover {
            color: #1C1C1C !important;
        }

        .xc-view-all-link:hover::after {
            width: 100%;
        }

        .xc-view-all-link i {
            font-size: 14px;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .xc-view-all-link:hover i {
            transform: translateX(5px);
        }

        /* Feature items animations */
        .xc-feature-one__item {
            animation: slideInUp 0.8s ease-out backwards;
            transition: all 0.4s ease;
            position: relative;
        }

        .xc-feature-one__item:nth-child(1) { animation-delay: 0.1s; }
        .xc-feature-one__item:nth-child(2) { animation-delay: 0.2s; }
        .xc-feature-one__item:nth-child(3) { animation-delay: 0.3s; }
        .xc-feature-one__item:nth-child(4) { animation-delay: 0.4s; }

        .xc-feature-one__item:hover {
            transform: translateY(-8px);
        }

        .xc-feature-one__icon {
            animation: floatingGold 4s ease-in-out infinite;
            transition: all 0.3s ease;
        }

        .xc-feature-one__item:hover .xc-feature-one__icon {
            animation: floatingGold 2s ease-in-out infinite;
            color: #0066CC;
        }

        /* Ads animation */
        .xc-ads-one__img {
            animation: slideInUp 0.8s ease-out;
            transition: all 0.4s ease;
        }

        .xc-ads-one__img:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(0, 102, 204, 0.2);
        }
    </style>
@endsection
