@extends('admin.layouts.app')

@section('title', 'Détails de la commande')

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Commande {{ $commande->numero_commande }}</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <a href="{{ route('admin.commandes.index') }}">
                                <div class="text-tiny">Commandes</div>
                            </a>
                        </li>
                        <li><i class="icon-chevron-right"></i></li>
                        <li>
                            <div class="text-tiny">{{ $commande->numero_commande }}</div>
                        </li>
                    </ul>
                </div>

                <!-- Détails de la commande -->
                <div class="wg-order-detail">
                    <div class="left flex-grow">
                        <div class="wg-box mb-20">
                            <div class="wg-table table-order-detail">
                                <ul class="table-title flex items-center justify-between gap20 mb-24">
                                    <li>
                                        <div class="body-title">Articles de la commande</div>
                                    </li>
                                </ul>
                                <ul class="flex flex-column">
                                    @foreach($commande->items as $item)
                                        <li class="product-item gap14">
                                            @if($item->produit && $item->produit->image)
                                                <div class="image no-bg">
                                                    <img src="{{ asset('storage/' . $item->produit->image) }}" 
                                                         alt="{{ $item->nom_produit }}">
                                                </div>
                                            @else
                                                <div class="image no-bg">
                                                    <img src="{{ asset('assets/img/placeholder.png') }}" 
                                                         alt="{{ $item->nom_produit }}">
                                                </div>
                                            @endif
                                            <div class="flex items-center justify-between gap40 flex-grow">
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Produit</div>
                                                    <div class="body-title-2">{{ $item->nom_produit }}</div>
                                                    @if($item->marque_produit)
                                                        <div class="text-tiny text-muted">{{ $item->marque_produit }}</div>
                                                    @endif
                                                </div>
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Quantité</div>
                                                    <div class="body-title-2">{{ $item->quantite }}</div>
                                                </div>
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Prix unitaire</div>
                                                    <div class="body-title-2">{{ number_format($item->prix_unitaire, 0, ',', ' ') }} FCFA</div>
                                                </div>
                                                <div class="name">
                                                    <div class="text-tiny mb-1">Sous-total</div>
                                                    <div class="body-title-2">{{ number_format($item->sous_total, 0, ',', ' ') }} FCFA</div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="wg-box">
                            <div class="wg-table table-cart-totals">
                                <ul class="table-title flex mb-24">
                                    <li>
                                        <div class="body-title">Totaux</div>
                                    </li>
                                    <li>
                                        <div class="body-title">Montant</div>
                                    </li>
                                </ul>
                                <ul class="flex flex-column gap14">
                                    <li class="cart-totals-item">
                                        <span class="body-text">Sous-total:</span>
                                        <span class="body-title-2">{{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</span>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-text">Frais de livraison:</span>
                                        <span class="body-title-2">{{ number_format($commande->frais_livraison, 0, ',', ' ') }} FCFA</span>
                                    </li>
                                    <li class="divider"></li>
                                    <li class="cart-totals-item">
                                        <span class="body-title">Total:</span>
                                        <span class="body-title tf-color-1">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="right">
                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Résumé</div>
                            <div class="summary-item">
                                <div class="body-text">Numéro de commande</div>
                                <div class="body-title-2">{{ $commande->numero_commande }}</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Date</div>
                                <div class="body-title-2">{{ $commande->created_at->format('d/m/Y H:i') }}</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Total</div>
                                <div class="body-title-2 tf-color-1">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</div>
                            </div>
                            <div class="summary-item">
                                <div class="body-text">Statut</div>
                                <div class="block-{{ $commande->statut_badge }}">{{ $commande->statut_libelle }}</div>
                            </div>
                        </div>

                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Informations client</div>
                            <div class="body-text"><strong>Nom:</strong> {{ $commande->nom_client_complet }}</div>
                            @if($commande->email_client || $commande->user?->email)
                                <div class="body-text"><strong>Email:</strong> {{ $commande->email_client ?? $commande->user->email }}</div>
                            @endif
                            @if($commande->telephone_client)
                                <div class="body-text"><strong>Téléphone:</strong> {{ $commande->telephone_client }}</div>
                            @endif
                        </div>

                        @if($commande->adresse_livraison)
                            <div class="wg-box mb-20 gap10">
                                <div class="body-title">Adresse de livraison</div>
                                <div class="body-text">{{ $commande->adresse_livraison }}</div>
                            </div>
                        @endif

                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Méthode de paiement</div>
                            <div class="body-text">{{ $commande->methode_paiement ?? 'Non spécifiée' }}</div>
                            <div class="body-text"><strong>Statut:</strong> {{ ucfirst($commande->statut_paiement) }}</div>
                        </div>

                        <!-- Formulaire de mise à jour du statut -->
                        <div class="wg-box mb-20 gap10">
                            <div class="body-title">Changer le statut</div>
                            <form action="{{ route('admin.commandes.updateStatus', $commande) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="statut" class="form-select mb-2" required>
                                    <option value="en_attente" {{ $commande->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmee" {{ $commande->statut == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="en_preparation" {{ $commande->statut == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                                    <option value="expediee" {{ $commande->statut == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                                    <option value="livree" {{ $commande->statut == 'livree' ? 'selected' : '' }}>Livrée</option>
                                    <option value="annulee" {{ $commande->statut == 'annulee' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                <button type="submit" class="tf-button style-1 w-full">
                                    <i class="icon-check"></i>Mettre à jour
                                </button>
                            </form>
                        </div>

                        <!-- Formulaire de numéro de tracking -->
                        <div class="wg-box gap10">
                            <div class="body-title">Numéro de tracking</div>
                            <form action="{{ route('admin.commandes.updateTracking', $commande) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="numero_tracking" class="form-control mb-2" 
                                       value="{{ $commande->numero_tracking }}" placeholder="Entrez le numéro de tracking">
                                <button type="submit" class="tf-button style-1 w-full">
                                    <i class="icon-truck"></i>Enregistrer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
