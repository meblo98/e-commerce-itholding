@extends('layouts.app')

@section('title', 'Facture')

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
                        <span>Facture</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="pt-80 pb-80" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <!-- Facture professionnelle -->
                <div class="invoice-container">
                    <!-- En-tête de la facture -->
                    <div class="invoice-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="company-info">
                                    <h2 class="company-name">{{ config('app.name') }}</h2>
                                    <p class="company-tagline">Électroménager & Électronique de Qualité</p>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <div class="invoice-badge">FACTURE</div>
                                <p class="invoice-date mt-2">
                                    <strong>Date:</strong> {{ now()->format('d/m/Y') }}<br>
                                    <strong>N°:</strong> INV-{{ strtoupper(substr(md5(now()->timestamp), 0, 8)) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Informations client -->
                    <div class="client-info-section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h5 class="info-title">Facturé à</h5>
                                    <p class="mb-1"><strong>{{ auth()->user()->name ?? 'Client' }}</strong></p>
                                    <p class="mb-0 text-muted">{{ auth()->user()->email ?? '' }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <h5 class="info-title">Détails de paiement</h5>
                                    <p class="mb-1"><span class="payment-badge">En attente</span></p>
                                    <p class="mb-0 text-muted">Paiement à la livraison</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tableau des produits -->
                    <div class="products-section">
                        <table class="invoice-table">
                            <thead>
                                <tr>
                                    <th style="width: 40%;">Produit</th>
                                    <th style="width: 20%;">Marque</th>
                                    <th style="width: 10%;" class="text-center">Qté</th>
                                    <th style="width: 15%;" class="text-end">P.U (€)</th>
                                    <th style="width: 15%;" class="text-end">Total (€)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($panierItems as $item)
                                    <tr>
                                        <td>
                                            <div class="product-name">{{ $item->produit->nom }}</div>
                                            @if($item->produit->categorie)
                                                <div class="product-category">{{ $item->produit->categorie->titre }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="brand-badge">{{ $item->produit->marque->nom ?? '—' }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="quantity-badge">{{ $item->quantite }}</span>
                                        </td>
                                        <td class="text-end">{{ number_format($item->produit->prix, 2) }}</td>
                                        <td class="text-end"><strong>{{ number_format($item->produit->prix * $item->quantite, 2) }}</strong></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Totaux -->
                    <div class="totals-section">
                        <div class="row justify-content-end">
                            <div class="col-md-5">
                                <div class="totals-box">
                                    <div class="total-row">
                                        <span>Sous-total:</span>
                                        <span>{{ number_format($total, 2) }} €</span>
                                    </div>
                                    <div class="total-row">
                                        <span>TVA (20%):</span>
                                        <span>{{ number_format($total * 0.20, 2) }} €</span>
                                    </div>
                                    <div class="total-row total-final">
                                        <span>Total TTC:</span>
                                        <span>{{ number_format($total * 1.20, 2) }} €</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pied de page facture -->
                    <div class="invoice-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="footer-title">Conditions de paiement</h6>
                                <p class="footer-text">Paiement à la livraison. Garantie satisfait ou remboursé sous 14 jours.</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h6 class="footer-title">Merci pour votre confiance !</h6>
                                <p class="footer-text">Pour toute question, contactez-nous au support client.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="action-buttons">
                        <a href="{{ route('panier.whatsapp') }}" class="btn-invoice btn-whatsapp">
                            <i class="fab fa-whatsapp"></i> Commander sur WhatsApp
                        </a>
                        <button onclick="window.print()" class="btn-invoice btn-print">
                            <i class="fas fa-print"></i> Imprimer
                        </button>
                        <a href="{{ route('panier.index') }}" class="btn-invoice btn-back">
                            <i class="fas fa-arrow-left"></i> Retour au panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* =========================== FACTURE PROFESSIONNELLE =========================== */
    .invoice-container {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        animation: slideInUp 0.6s ease-out;
    }

    /* En-tête de facture */
    .invoice-header {
        background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
        color: white;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }

    .invoice-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .company-name {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
        color: white;
    }

    .company-tagline {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    .invoice-badge {
        display: inline-block;
        background: white;
        color: #B88A2E;
        padding: 8px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 18px;
        letter-spacing: 2px;
    }

    .invoice-date {
        color: rgba(255, 255, 255, 0.95);
        font-size: 14px;
        margin: 0;
    }

    /* Section informations client */
    .client-info-section {
        padding: 30px 40px;
        background: #f8f9fa;
        border-bottom: 3px solid #B88A2E;
    }

    .info-box {
        margin-bottom: 0;
    }

    .info-title {
        color: #B88A2E;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .payment-badge {
        background: #ffc107;
        color: #000;
        padding: 4px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Section produits */
    .products-section {
        padding: 20px 40px;
    }

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin: 0;
    }

    .invoice-table thead {
        background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
        color: white;
    }

    .invoice-table thead th {
        padding: 16px 12px;
        font-weight: 600;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
    }

    .invoice-table tbody tr {
        border-bottom: 1px solid #e9ecef;
        transition: background 0.2s ease;
    }

    .invoice-table tbody tr:hover {
        background: #f8f9fa;
    }

    .invoice-table tbody td {
        padding: 20px 12px;
        vertical-align: middle;
    }

    .product-name {
        font-weight: 600;
        color: #2A2A2A;
        margin-bottom: 4px;
    }

    .product-category {
        font-size: 12px;
        color: #6c757d;
    }

    .brand-badge {
        background: #e9ecef;
        color: #495057;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .quantity-badge {
        background: #B88A2E;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 600;
        display: inline-block;
        min-width: 40px;
    }

    /* Section totaux */
    .totals-section {
        padding: 20px 40px 30px;
        background: #f8f9fa;
    }

    .totals-box {
        background: white;
        border-radius: 8px;
        padding: 20px;
        border: 2px solid #e9ecef;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        font-size: 15px;
        color: #495057;
        border-bottom: 1px solid #e9ecef;
    }

    .total-row:last-child {
        border-bottom: none;
    }

    .total-final {
        background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
        color: white;
        margin: 15px -20px -20px;
        padding: 20px;
        border-radius: 0 0 6px 6px;
        font-size: 20px;
        font-weight: 700;
    }

    /* Pied de page facture */
    .invoice-footer {
        padding: 30px 40px;
        background: #f8f9fa;
        border-top: 3px solid #B88A2E;
    }

    .footer-title {
        color: #B88A2E;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .footer-text {
        font-size: 13px;
        color: #6c757d;
        margin: 0;
    }

    /* Boutons d'action */
    .action-buttons {
        padding: 30px 40px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        justify-content: center;
        background: white;
    }

    .btn-invoice {
        padding: 14px 28px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 15px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-whatsapp {
        background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
    }

    .btn-whatsapp:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
        color: white;
    }

    .btn-print {
        background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(184, 138, 46, 0.3);
    }

    .btn-print:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(184, 138, 46, 0.4);
    }

    .btn-back {
        background: #e9ecef;
        color: #495057;
    }

    .btn-back:hover {
        background: #dee2e6;
        transform: translateY(-2px);
        color: #495057;
    }

    /* Impression */
    @media print {
        body * {
            visibility: hidden;
        }
        .invoice-container, .invoice-container * {
            visibility: visible;
        }
        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
        }
        .action-buttons {
            display: none !important;
        }
        .xc-breadcrumb__area {
            display: none !important;
        }
    }

    /* Animation */
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

    /* Responsive */
    @media (max-width: 768px) {
        .invoice-header,
        .client-info-section,
        .products-section,
        .totals-section,
        .invoice-footer,
        .action-buttons {
            padding: 20px;
        }

        .company-name {
            font-size: 24px;
        }

        .invoice-badge {
            font-size: 14px;
            padding: 6px 16px;
        }

        .invoice-table {
            font-size: 13px;
        }

        .invoice-table thead th,
        .invoice-table tbody td {
            padding: 12px 8px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-invoice {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection
