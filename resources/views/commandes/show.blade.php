@extends('layouts.app')

@section('title', 'Détails de ma commande')

@section('content')
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Détail Commande</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ route('commandes.index') }}">Mes Commandes</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="xc-order-detail-area pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0">Commande #{{ $commande->numero_commande }}</h4>
                            <span class="badge bg-{{ $commande->statut_badge }} fs-6">
                                {{ $commande->statut_libelle }}
                            </span>
                        </div>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Prix</th>
                                        <th>Qté</th>
                                        <th class="text-end">Sous-total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commande->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->produit && $item->produit->image)
                                                        <img src="{{ asset('storage/' . $item->produit->image) }}" 
                                                             alt="{{ $item->nom_produit }}" 
                                                             style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;" class="me-2">
                                                    @endif
                                                    <div>
                                                        <div class="fw-bold">{{ $item->nom_produit }}</div>
                                                        <small class="text-muted">{{ $item->marque_produit }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                                            <td>{{ $item->quantite }}</td>
                                            <td class="text-end fw-bold">{{ number_format($item->sous_total, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end border-0">Sous-total</td>
                                        <td class="text-end fw-bold border-0">{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                    @if($commande->frais_livraison > 0)
                                        <tr>
                                            <td colspan="3" class="text-end border-0">Frais de livraison</td>
                                            <td class="text-end fw-bold border-0">{{ number_format($commande->frais_livraison, 0, ',', ' ') }} FCFA</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3" class="text-end fs-5 fw-bold text-dark">Total</td>
                                        <td class="text-end fs-5 fw-bold text-primary">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    @if($commande->notes)
                        <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                            <h5>Notes de la commande</h5>
                            <p class="mb-0 text-muted">{{ $commande->notes }}</p>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h5 class="mb-3">Informations de livraison</h5>
                        <p class="mb-1"><strong>Destinataire:</strong> {{ $commande->nom_client }}</p>
                        <p class="mb-1"><strong>Téléphone:</strong> {{ $commande->telephone_client }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $commande->email_client }}</p>
                        <p class="mb-0"><strong>Adresse:</strong><br>{{ $commande->adresse_livraison }}</p>
                    </div>

                    <div class="bg-white p-4 rounded-3 shadow-sm mb-4">
                        <h5 class="mb-3">Paiement</h5>
                        <p class="mb-1"><strong>Méthode:</strong> {{ $commande->methode_paiement }}</p>
                        <p class="mb-0"><strong>Statut:</strong> {{ ucfirst($commande->statut_paiement) }}</p>
                    </div>

                    @if($commande->numero_tracking)
                        <div class="bg-white p-4 rounded-3 shadow-sm mb-4 border border-primary">
                            <h5 class="mb-3"><i class="icon-truck"></i> Suivi de livraison</h5>
                            <p class="mb-1">Votre numéro de suivi :</p>
                            <div class="bg-light p-2 rounded text-center fw-bold fs-5">
                                {{ $commande->numero_tracking }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
