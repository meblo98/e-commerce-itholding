@extends('layouts.app')

@section('title', 'Détail Produit')

@section('content')

    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span>Détail Produit</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- xc-breadcrumb area end -->

    <!-- product details area start -->
    <section class="product__details-area pt-80 pb-80">
        <div class="container">
            <div class="row gutter-y-30">
                <div class="col-xl-6 col-lg-6">
                    <div class="product__details-thumb-tab">
                        <div class="product__details-thumb-content w-img">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-one" role="tabpanel"
                                    aria-labelledby="nav-one-tab">
                                    <img src="{{ asset('storage/' . ($produit->image ?? '')) }}"
                                        alt="{{ $produit->nom ?? 'Produit' }}">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="product__details-thumb-nav xc-tab">
                            <nav>
                                <div class="nav nav-tabs justify-content-sm-between" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-one-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-one" type="button" role="tab" aria-controls="nav-one"
                                        aria-selected="true">
                                        <img src="{{ asset('assets/img/product-details/product-details-sm-1.png') }}" alt="">
                                    </button>
                                    <button class="nav-link" id="nav-two-tab" data-bs-toggle="tab" data-bs-target="#nav-two"
                                        type="button" role="tab" aria-controls="nav-two" aria-selected="false">
                                        <img src="{{ asset('assets/img/product-details/product-details-sm-2.png') }}" alt="">
                                    </button>
                                    <button class="nav-link" id="nav-three-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-three" type="button" role="tab" aria-controls="nav-three"
                                        aria-selected="false">
                                        <img src="{{ asset('assets/img/product-details/product-details-sm-3.png') }}" alt="">
                                    </button>
                                    <button class="nav-link" id="nav-four-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-four" type="button" role="tab" aria-controls="nav-four"
                                        aria-selected="false">
                                        <img src="{{ asset('assets/img/product-details/product-details-sm-4.png') }}" alt="">
                                    </button>
                                </div>
                            </nav>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="product__details-wrapper">

                        <!-- <div class="product__details-stock">
                                        <span>18 In Stock</span>
                                    </div> -->
                        <h3 class="product__details-title">{{ $produit->nom ?? 'Produit' }}</h3>

                        <div class="product__details-rating d-flex align-items-center">
                            <div class="product__rating product__rating-2 d-flex">
                                <span>
                                    <i class="icon-star"></i>
                                </span>
                                <span>
                                    <i class="icon-star"></i>
                                </span>
                                <span>
                                    <i class="icon-star"></i>
                                </span>
                                <span>
                                    <i class="icon-star"></i>
                                </span>
                                <span>
                                    <i class="icon-star"></i>
                                </span>
                            </div>
                            <div class="product__details-rating-count">
                                <span>({{ $produit->stock ?? 0 }} reviews)</span>
                            </div>
                        </div>

                        <p>{{ $produit->description ?? 'Description indisponible.' }}</p>





                        <div class="product__details-meta mb-3">
                            <p><strong>Marque :</strong> {{ $produit->marque->nom ?? '—' }}</p>
                            <p><strong>Catégorie :</strong> {{ $produit->categorie->titre ?? '—' }}</p>
                            <p><strong>Stock :</strong> {{ $produit->stock ?? 0 }}</p>
                        </div>

                        <div class="product__details-action d-flex flex-wrap align-items-center">
                            <form action="{{ route('panier.add', $produit->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="product-add-cart-btn swiftcart-btn swiftcart-btn-2">
                                    <i class="icon-shopping-cart"></i> Ajouter au panier
                                </button>
                            </form>
                            <a href="{{ url('/produits') }}" class="btn btn-light ms-3">Retour à la liste</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product details area end -->

    <!-- product details tab area start -->
    {{-- <section class="product__details-tab-area pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="product__details-tab-nav">
                        <nav>
                            <div class="product__details-tab-nav-inner nav xc-tab-menu d-flex flex-sm-nowrap flex-wrap"
                                id="nav-tab-info" role="tablist">

                                <button class="nav-link active" id="nav-desc-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-desc" type="button" role="tab" aria-controls="nav-desc"
                                    aria-selected="true">Description</button>
                                <span id="marker" class="xc-tab-line d-none d-sm-inline-block"></span>
                            </div>
                        </nav>
                    </div>
                    <div class="product__details-tab-content">
                        <div class="tab-content" id="nav-tabContent-info">
                            <div class="tab-pane fade show active" id="nav-desc" role="tabpanel"
                                aria-labelledby="nav-desc-tab">
                                <div class="product__details-description product__details-review-inner mt-60">
                                    <div class="product__details-description-content">
                                        <p class="mb-0">
                                            {{ $produit->description ?? 'Description indisponible.' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- product details tab area end -->
@endsection
