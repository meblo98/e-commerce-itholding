@extends('layouts.app')

@section('title', 'Commande confirmée')

@section('content')
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Succès</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="xc-success-area pt-100 pb-100 text-center">
        <div class="container">
            <div class="success-icon mb-30">
                <i class="icon-check-circle text-success" style="font-size: 100px;"></i>
            </div>
            <h2 class="mb-20">Merci pour votre commande !</h2>
            <p class="text-muted fs-5 mb-40">
                Votre commande <strong>#{{ $commande->numero_commande }}</strong> a été enregistrée avec succès.<br>
                Nous vous contacterons très prochainement pour la livraison.
            </p>
            
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('commandes.index') }}" class="btn btn-primary px-4 py-2">
                    <i class="icon-list"></i> Voir mes commandes
                </a>
                <a href="{{ url('/produits') }}" class="btn btn-outline-primary px-4 py-2">
                    <i class="icon-shopping-bag"></i> Continuer mes achats
                </a>
            </div>
        </div>
    </section>
@endsection
