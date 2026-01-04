@extends('layouts.app')

@section('title', 'Page Produit')

@section('content')

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
                            <span>Produits</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- xc-breadcrumb area end -->
    <section class="xc-shop-area pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="xc-shop-main-wrapper">
                        <div class="xc-shop-top mb-45 bg-white">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="xc-shop-top-left d-flex align-items-center ">
                                        <div class="xc-shop-top-result">
                                            <p>
                                                Affichage des produits
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- ici j'aurais les categories clickable qui permet si je le click j'aurais les
                                    produits correspondant --}}
                                    <div class="xc-shop-top-right d-sm-flex align-items-center justify-content-md-end">
                                        <div class="xc-header-one__cat" style="position: relative;">
                                            <button type="button" id="shopCatToggle" aria-expanded="false" aria-controls="shopCatList"
                                                    style="display: inline-flex; align-items: center; gap: 8px; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; background: #fff; box-shadow: 0 6px 16px rgba(0,0,0,0.06); cursor: pointer;">
                                                <i class="icon-menu"></i>
                                                <span>
                                                    @if(empty($selectedCategoryId))
                                                        Toutes les catégories
                                                    @else
                                                        {{ optional($categories->firstWhere('id', $selectedCategoryId))->titre ?? 'Catégories' }}
                                                    @endif
                                                </span>
                                                <i class="icon-arrow-down" style="margin-left: auto;"></i>
                                            </button>
                                            <div id="shopCatList" style="display: none; max-height: 500px; overflow-y: auto; border: 1px solid #e5e7eb; border-radius: 10px; padding: 10px 14px; background: #fff; box-shadow: 0 6px 16px rgba(0,0,0,0.12); position: absolute; right: 0; top: calc(100% + 8px); min-width: 240px; z-index: 5;">
                                                <ul style="list-style:none; margin:0; padding:0;">
                                                    <li style="margin-bottom:6px;">
                                                        <a href="{{ url('/produits') }}" class="{{ empty($selectedCategoryId) ? 'active' : '' }}" style="display:block; padding:8px 10px; color:#0f172a; text-decoration:none; border-radius:8px;">Toutes les catégories</a>
                                                    </li>
                                                    @foreach($categories as $cat)
                                                        <li style="margin-bottom:6px;">
                                                            <a href="{{ url('/produits') }}?cat={{ $cat->id }}" class="{{ $selectedCategoryId == $cat->id ? 'active' : '' }}" style="display:block; padding:8px 10px; color:#0f172a; text-decoration:none; border-radius:8px;">
                                                                {{ $cat->titre }}
                                                                @if($cat->produits->count() > 0)
                                                                    <span style="color:#999; font-size:0.85em;">({{ $cat->produits->count() }})</span>
                                                                @else
                                                                    <span style="color:#ccc; font-size:0.85em;">(vide)</span>
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- Mix de produits sans filtres au début --}}
                        @if(!empty($selectedCategoryId) || true)
                            <div style="margin-bottom: 60px;">
                                <div style="margin-bottom: 30px;">
                                    <h3 style="font-size: 24px; font-weight: 600; color: #0f172a; margin-bottom: 15px;">
                                        <span style="color: #0b54c9;"><i class="icon-power"></i></span> Découvrez nos produits
                                    </h3>
                                </div>
                                <div class="xc-shop-items-wrapper xc-shop-item-primary">
                                    <div class="row gutter-y-20">
                                        @forelse ($productsPreview as $p)
                                            <div class="col-xl-3 col-md-6 col-sm-6 infinite-item">
                                                <div class="xc-product-two__item">
                                                    <span class="xc-product-two__deal d-none">BEST DEALS</span>
                                                    <div class="xc-product-two__img">
                                                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->nom }}">
                                                    </div>
                                                    <h3 class="xc-product-two__title">
                                                        <a href="{{ url('/produit/'.$p->id) }}">{{ $p->nom }}</a>
                                                    </h3>
                                                    <h4 class="xc-product-two__price">
                                                        {{ number_format($p->prix, 0, ',', ' ') }} FCFA
                                                    </h4>
                                                    <div class="xc-product-two__btn">
                                                        <a href="{{ url('/produit/'.$p->id) }}"><i class="icon-eye"></i></a>
                                                        <a href="#" onclick="event.preventDefault(); this.nextElementSibling.submit();">
                                                            <i class="icon-shopping-cart"></i>
                                                        </a>
                                                        <form action="{{ route('panier.add', $p->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">Aucun produit trouvé.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- ici j'aurais les produits afficher en fonction des categories clicker dont ça va etre dynamique
                        en fonction de la categgorie --}}
                        @if(!empty($selectedCategoryId))
                            <div>
                                <h3 style="font-size: 24px; font-weight: 600; color: #0f172a; margin-bottom: 30px;">
                                    <span style="color: #0b54c9;"><i class="icon-filter"></i></span> Résultats par catégorie
                                </h3>
                            </div>
                        @endif
                        <div class="xc-shop-items-wrapper xc-shop-item-primary">
                            <div class="row gutter-y-20">

                                @forelse ($produits as $p)
                                    <div class="col-xl-3 col-md-6 col-sm-6 infinite-item">
                                        <div class="xc-product-two__item">
                                            <span class="xc-product-two__deal d-none">BEST DEALS</span>
                                            <div class="xc-product-two__img">
                                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->nom }}">
                                            </div>
                                            <h3 class="xc-product-two__title">
                                                <a href="{{ url('/produit/'.$p->id) }}">{{ $p->nom }}</a>
                                            </h3>
                                            <h4 class="xc-product-two__price">
                                                {{ number_format($p->prix, 0, ',', ' ') }} FCFA
                                            </h4>
                                            <div class="xc-product-two__btn">
                                                <a href="{{ url('/produit/'.$p->id) }}"><i class="icon-eye"></i></a>
                                                <a href="#" onclick="event.preventDefault(); this.nextElementSibling.submit();">
                                                    <i class="icon-shopping-cart"></i>
                                                </a>
                                                <form action="{{ route('panier.add', $p->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center">Aucun produit disponible dans cette catégorie.</p>
                                @endforelse

                            </div>
                        </div>
                        <div class="xc-shop-pagination mt-20">
                            <div class="xc-pagination text-center">
                                <ul>
                                    {{-- Précédent --}}
                                    @if ($produits->onFirstPage())
                                        <li class="disabled">
                                            <span class="prev page-numbers"><i class="fa-solid fa-angle-left"></i></span>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ $produits->previousPageUrl() }}" class="prev page-numbers">
                                                <i class="fa-solid fa-angle-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    {{-- Première page --}}
                                    @if ($produits->currentPage() > 3)
                                        <li><a href="{{ $produits->url(1) }}">1</a></li>
                                        @if ($produits->currentPage() > 4)
                                            <li><span>...</span></li>
                                        @endif
                                    @endif

                                    {{-- Pages autour de la page actuelle --}}
                                    @for ($i = max(1, $produits->currentPage() - 2); $i <= min($produits->lastPage(), $produits->currentPage() + 2); $i++)
                                        <li>
                                            @if ($i == $produits->currentPage())
                                                <a class="current" href="{{ $produits->url($i) }}">{{ $i }}</a>
                                            @else
                                                <a href="{{ $produits->url($i) }}">{{ $i }}</a>
                                            @endif
                                        </li>
                                    @endfor

                                    {{-- Dernière page --}}
                                    @if ($produits->currentPage() < $produits->lastPage() - 2)
                                        @if ($produits->currentPage() < $produits->lastPage() - 3)
                                            <li><span>...</span></li>
                                        @endif
                                        <li><a href="{{ $produits->url($produits->lastPage()) }}">{{ $produits->lastPage() }}</a></li>
                                    @endif

                                    {{-- Suivant --}}
                                    @if ($produits->hasMorePages())
                                        <li>
                                            <a href="{{ $produits->nextPageUrl() }}" class="next page-numbers">
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="disabled">
                                            <span class="next page-numbers"><i class="fa-solid fa-angle-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('shopCatToggle');
            const list = document.getElementById('shopCatList');
            if (!toggle || !list) return;

            const closeList = () => {
                list.style.display = 'none';
                toggle.setAttribute('aria-expanded', 'false');
            };

            toggle.addEventListener('click', function(event) {
                event.stopPropagation();
                const isOpen = list.style.display === 'block';
                list.style.display = isOpen ? 'none' : 'block';
                toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
            });

            document.addEventListener('click', function(event) {
                if (!list.contains(event.target) && !toggle.contains(event.target)) {
                    closeList();
                }
            });
        });
    </script>

    <style>
        /* Images des cartes uniformisées */
        .xc-product-two__img,
        .xc-product-three__img {
            border-radius: 12px;
            overflow: hidden;
            background: #f5f7fb;
        }
        .dark .xc-product-two__img,
        .dark .xc-product-three__img {
            background: #0f172a;
        }
        .xc-product-two__img img,
        .xc-product-three__img img {
            display: block;
            margin: 0 auto;
            width: 100%;
            height: 180px;
            object-fit: cover;
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
            color: var(--swiftcart-base);
        }
        .xc-header-one__cat a.active {
            font-weight: 700;
            color: #0b54c9;
            background-color: #e8efff;
        }
        .xc-header-one__cat a:hover {
            background-color: #f1f5f9;
            color: #0b54c9;
        }
        #shopCatToggle {
            border: 1px solid #0b54c9 !important;
            box-shadow: 0 6px 16px rgba(11, 84, 201, 0.15);
        }
        #shopCatList {
            border: 1px solid #0b54c9 !important;
            box-shadow: 0 10px 28px rgba(11, 84, 201, 0.18);
        }
    </style>

@endsection
