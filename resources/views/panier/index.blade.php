@extends('layouts.app')
@section('title', 'Mon Panier')
@section('content')
    <!-- xc-breadcrumb area start -->
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Panier</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- xc-breadcrumb area end -->
    <section class="xc-cart-area pt-80 pb-80">
        <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if($panierItems->count() > 0)
            <div class="row">
                <div class="col-xl-8">
                    <div class="xc-cart-wrapper bg-white p-4 rounded-3 shadow-sm">
                        <h3 class="mb-4">Articles dans votre panier</h3>
                        <div class="table-responsive">
                            <table class="table xc-cart-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($panierItems as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $item->produit->image) }}" alt="{{ $item->produit->nom }}" class="cart-product-img me-3" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                                                <div>
                                                    <h6 class="mb-1">{{ $item->produit->nom }}</h6>
                                                    <small class="text-muted">{{ $item->produit->marque->nom ?? '—' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="d-inline-flex align-items-center gap-2">
                                                <!-- Moins -->
                                                <form action="{{ route('panier.update', $item->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="quantite" value="{{ max(1, $item->quantite - 1) }}">
                                                    <button type="submit" class="btn btn-sm btn-outline-secondary" {{ $item->quantite <= 1 ? 'disabled' : '' }} title="Diminuer">
                                                        <span aria-hidden="true">−</span>
                                                    </button>
                                                </form>

                                                <!-- Quantité affichée -->
                                                <span class="fw-semibold">{{ $item->quantite }}</span>

                                                <!-- Plus -->
                                                <form action="{{ route('panier.update', $item->id) }}" method="POST">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="hidden" name="quantite" value="{{ $item->quantite + 1 }}">
                                                    <button type="submit" class="btn btn-sm btn-primary" title="Augmenter">
                                                        <span aria-hidden="true">+</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <form action="{{ route('panier.remove', $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger cart-remove-btn" title="Retirer">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <form action="{{ route('panier.clear') }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="icon-trash"></i> Vider le panier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="xc-cart-summary bg-white p-4 rounded-3 shadow-sm">
                        <h4 class="mb-4">Résumé de la commande</h4>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Nombre d'articles:</span>
                            <strong>{{ $panierItems->sum('quantite') }}</strong>
                        </div>
                        <hr>
                        <div class="d-grid gap-3 mt-4">
                            <a href="{{ route('panier.whatsapp') }}" class="btn btn-success w-100 mb-3 cart-cta">
                                <i class="fab fa-whatsapp"></i> Commander sur WhatsApp
                            </a>
                            <a href="{{ url('/produits') }}" class="btn btn-outline-primary w-100 cart-cta">
                                <i class="icon-arrow-left"></i> Continuer mes achats
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="icon-shopping-cart" style="font-size: 80px; color: #ccc;"></i>
                <h3 class="mb-3">Votre panier est vide</h3>
                <p class="text-muted mb-4">Vous n'avez pas encore ajouté de produits à votre panier.</p>
                <a href="{{ url('/produits') }}" class="btn btn-primary">
                    <i class="icon-shopping-bag"></i> Découvrir nos produits
                </a>
            </div>
        @endif
        </div>
    </section>
<style>
    .cart-product-img{
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }
    .alert {
        position: sticky;
        top: 20px;
    }
    .xc-cart-summary {
        vertical-align: middle;
    }
    .xc-cart-table td {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .xc-cart-table th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        background-color: #e9ecef;
    }
    .cart-cta {
        padding-top: 12px;
        padding-bottom: 12px;
        font-size: 1rem;
    }
    /* Réduction de la croix (supprimer) */
    .cart-remove-btn {
        padding: 2px 6px;
        line-height: 1;
    }
    .cart-remove-btn i {
        font-size: 12px;
    }

</style>
@endsection
