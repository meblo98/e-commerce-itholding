@extends('layouts.app')

@section('title', 'Validation de commande')

@section('content')
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Checkout</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ route('panier.index') }}">Panier</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="xc-checkout-area pt-80 pb-80">
        <div class="container">
            <form action="{{ route('place.order') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="xc-checkout-billing bg-white p-4 rounded-3 shadow-sm mb-30">
                            <h4 class="mb-4">Informations de livraison</h4>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="nom_client" class="form-label">Nom complet *</label>
                                    <input type="text" class="form-control" id="nom_client" name="nom_client" 
                                           value="{{ auth()->user()->name }} {{ auth()->user()->lastname }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_client" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email_client" name="email_client" 
                                           value="{{ auth()->user()->email }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telephone_client" class="form-label">Téléphone *</label>
                                    <input type="text" class="form-control" id="telephone_client" name="telephone_client" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="adresse_livraison" class="form-label">Adresse complète de livraison *</label>
                                    <textarea class="form-control" id="adresse_livraison" name="adresse_livraison" rows="3" required></textarea>
                                </div>
                            </div>

                            <h4 class="mb-4 mt-4">Méthode de paiement</h4>
                            <div class="payment-methods">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="methode_paiement" id="cod" value="Paiement à la livraison" checked>
                                    <label class="form-check-label" for="cod">
                                        Paiement à la livraison (Cash)
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="methode_paiement" id="wave" value="Wave/Orange Money">
                                    <label class="form-check-label" for="wave">
                                        Wave / Orange Money
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="xc-checkout-summary bg-white p-4 rounded-3 shadow-sm">
                            <h4 class="mb-4">Votre commande</h4>
                            <div class="order-items mb-4">
                                @foreach($panierItems as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">{{ $item->produit->nom }} x {{ $item->quantite }}</span>
                                        <span class="fw-bold">{{ number_format($item->produit->prix * $item->quantite, 0, ',', ' ') }} FCFA</span>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total</span>
                                <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5 fw-bold text-dark">Total</span>
                                <span class="fs-5 fw-bold text-primary">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100 py-3 fs-5">
                                <i class="icon-check"></i> Confirmer la commande
                            </button>
                            
                            <p class="text-muted mt-3 small text-center">
                                En confirmant, vous acceptez nos conditions générales de vente.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
