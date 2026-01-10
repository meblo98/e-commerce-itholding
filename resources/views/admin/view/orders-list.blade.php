@extends('admin.layouts.app')

@section('title', 'Liste des commandes')

@section('content')

    <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                    <h3>Liste des commandes</h3>
                    <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                        <li>
                            <a href="{{ route('admin') }}">
                                <div class="text-tiny">Dashboard</div>
                            </a>
                        </li>
                        <li>
                            <i class="icon-chevron-right"></i>
                        </li>
                        <li>
                            <div class="text-tiny">Commandes</div>
                        </li>
                    </ul>
                </div>

                <!-- Statistiques -->
                <div class="flex gap20 flex-wrap mb-20">
                    <div class="wg-chart-default flex-grow">
                        <div class="body-text mb-2">Total</div>
                        <h4>{{ number_format($stats['total']) }}</h4>
                    </div>
                    <div class="wg-chart-default flex-grow">
                        <div class="body-text mb-2">En attente</div>
                        <h4 class="text-warning">{{ number_format($stats['en_attente']) }}</h4>
                    </div>
                    <div class="wg-chart-default flex-grow">
                        <div class="body-text mb-2">Confirmées</div>
                        <h4 class="text-info">{{ number_format($stats['confirmee']) }}</h4>
                    </div>
                    <div class="wg-chart-default flex-grow">
                        <div class="body-text mb-2">Livrées</div>
                        <h4 class="text-success">{{ number_format($stats['livree']) }}</h4>
                    </div>
                </div>

                <!-- Liste des commandes -->
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap mb-20">
                        <div class="wg-filter flex-grow">
                            <form method="GET" action="{{ route('admin.commandes.index') }}" class="form-search">
                                <fieldset class="name">
                                    <input type="text" name="search" placeholder="Rechercher une commande..." 
                                           value="{{ request('search') }}" class="">
                                </fieldset>
                                <div class="button-submit">
                                    <button type="submit"><i class="icon-search"></i></button>
                                </div>
                            </form>
                        </div>
                        <a class="tf-button style-1 w208" href="{{ route('admin.commandes.export', request()->all()) }}">
                            <i class="icon-file-text"></i>Exporter
                        </a>
                    </div>

                    <!-- Filtres -->
                    <div class="flex gap10 mb-20">
                        <form method="GET" action="{{ route('admin.commandes.index') }}" class="flex gap10">
                            <select name="statut" class="form-select" onchange="this.form.submit()">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmee" {{ request('statut') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                <option value="en_preparation" {{ request('statut') == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                                <option value="expediee" {{ request('statut') == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                                <option value="livree" {{ request('statut') == 'livree' ? 'selected' : '' }}>Livrée</option>
                                <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </form>
                    </div>

                    <div class="wg-table table-all-category">
                        <ul class="table-title flex gap20 mb-14">
                            <li><div class="body-title">Numéro</div></li>
                            <li><div class="body-title">Client</div></li>
                            <li><div class="body-title">Date</div></li>
                            <li><div class="body-title">Total</div></li>
                            <li><div class="body-title">Statut</div></li>
                            <li><div class="body-title">Actions</div></li>
                        </ul>
                        <ul class="flex flex-column">
                            @forelse($commandes as $commande)
                                <li class="product-item gap14">
                                    <div class="flex items-center justify-between gap20 flex-grow">
                                        <div class="name">
                                            <a href="{{ route('admin.commandes.show', $commande) }}" class="body-title-2">
                                                {{ $commande->numero_commande }}
                                            </a>
                                        </div>
                                        <div class="body-text">{{ $commande->nom_client_complet }}</div>
                                        <div class="body-text">{{ $commande->created_at->format('d/m/Y H:i') }}</div>
                                        <div class="body-text">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</div>
                                        <div>
                                            <div class="block-{{ $commande->statut_badge }}">
                                                {{ $commande->statut_libelle }}
                                            </div>
                                        </div>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.commandes.show', $commande) }}" class="item eye">
                                                <i class="icon-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.commandes.destroy', $commande) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="item trash" style="border: none; background: none; cursor: pointer;">
                                                    <i class="icon-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center p-3">Aucune commande trouvée</li>
                            @endforelse
                        </ul>
                    </div>

                    @if($commandes->hasPages())
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10">
                            <div class="text-tiny">Affichage de {{ $commandes->count() }} sur {{ $commandes->total() }} commandes</div>
                            {{ $commandes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
