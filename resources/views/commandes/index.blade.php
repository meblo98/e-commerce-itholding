@extends('layouts.app')

@section('title', 'Mes Commandes')

@section('content')
    <div class="xc-breadcrumb__area base-bg">
        <div class="xc-breadcrumb__bg w-img xc-breadcrumb__overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="xc-breadcrumb__content p-relative z-index-1">
                        <div class="xc-breadcrumb__list">
                            <span>Mes Commandes</span>
                            <span class="dvdr"><i class="icon-arrow-right"></i></span>
                            <span><a href="{{ url('/') }}">Accueil</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="xc-orders-area pt-80 pb-80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bg-white p-4 rounded-3 shadow-sm">
                        <h4 class="mb-4">Historique de mes commandes</h4>
                        
                        @if($commandes->count() > 0)
                            <div class="table-responsive">
                                <table class="table align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Commande</th>
                                            <th>Date</th>
                                            <th>Statut</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($commandes as $commande)
                                            <tr>
                                                <td class="fw-bold text-primary">#{{ $commande->numero_commande }}</td>
                                                <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $commande->statut_badge }}">
                                                        {{ $commande->statut_libelle }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold">{{ number_format($commande->total, 0, ',', ' ') }} FCFA</td>
                                                <td>
                                                    <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="icon-eye"></i> Détails
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $commandes->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="icon-file-text" style="font-size: 60px; color: #eee;"></i>
                                <h5 class="mt-3">Vous n'avez pas encore passé de commande.</h5>
                                <a href="{{ url('/produits') }}" class="btn btn-primary mt-3">Commencer mes achats</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
