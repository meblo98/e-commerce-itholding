<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Facture</title>
    <style>
        @page { margin: 15mm; size: A4; }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #2A2A2A;
            line-height: 1.3;
            position: relative;
            width: 210mm;
            margin: 0 auto;
        }

        /* Patterns de fond - réduits pour A4 */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0.02;
            background-image:
                repeating-linear-gradient(45deg, transparent, transparent 25px, rgba(184, 138, 46, 0.08) 25px, rgba(184, 138, 46, 0.08) 50px),
                repeating-linear-gradient(-45deg, transparent, transparent 25px, rgba(184, 138, 46, 0.04) 25px, rgba(184, 138, 46, 0.04) 50px);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
            padding: 8px;
            position: relative;
            z-index: 1;
        }

        /* En-tête professionnel - optimisé A4 */
        .header {
            background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
            color: white;
            padding: 12px 10px;
            margin: -8px -8px 10px -8px;
            border-radius: 0;
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -5%;
            width: 70px;
            height: 200%;
            background: rgba(255, 255, 255, 0.04);
            transform: rotate(15deg);
        }

        .header-content {
            display: table;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        .logo-container {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 3px;
            padding: 4px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .logo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-left, .header-right {
            display: table-cell;
            vertical-align: middle;
        }

        .header-right {
            text-align: right;
        }

        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .company-tagline {
            font-size: 7px;
            opacity: 0.95;
        }

        .invoice-badge {
            background: white;
            color: #0066CC;
            padding: 3px 8px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 8px;
            letter-spacing: 0.5px;
            display: inline-block;
            margin-bottom: 3px;
        }

        .invoice-number {
            font-size: 6px;
            opacity: 0.95;
        }

        /* Informations client - optimisé A4 */
        .info-section {
            background: #f8f9fa;
            padding: 8px;
            margin-bottom: 10px;
            border-left: 2px solid #B88A2E;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 0;
        }

        .info-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 6px;
        }

        .info-title {
            color: #B88A2E;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.2px;
            margin-bottom: 3px;
        }

        .info-text {
            font-size: 7px;
            color: #495057;
        }

        .payment-badge {
            background: #ffc107;
            color: #000;
            padding: 1px 6px;
            border-radius: 2px;
            font-size: 6px;
            font-weight: bold;
        }

        /* Tableau des produits - optimisé A4 */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        thead {
            background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
            color: white;
        }

        th {
            padding: 5px 4px;
            font-weight: bold;
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: 0.2px;
        }

        tbody tr {
            border-bottom: 1px solid #e9ecef;
        }

        tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        td {
            padding: 5px 4px;
            vertical-align: middle;
            font-size: 7px;
        }

        .product-name {
            font-weight: bold;
            color: #2A2A2A;
            margin-bottom: 1px;
            font-size: 7px;
        }

        .product-category {
            font-size: 6px;
            color: #6c757d;
        }

        .brand-badge {
            background: #e9ecef;
            color: #495057;
            padding: 1px 4px;
            border-radius: 2px;
            font-size: 6px;
            font-weight: 500;
        }

        .quantity-badge {
            background: #B88A2E;
            color: white;
            padding: 2px 6px;
            border-radius: 2px;
            font-weight: bold;
            display: inline-block;
            min-width: 20px;
            text-align: center;
            font-size: 7px;
        }

        /* Section totaux - optimisé A4 */
        .totals-section {
            width: 55%;
            margin-left: auto;
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }

        .total-row {
            display: table;
            width: 100%;
            padding: 4px 8px;
            border-bottom: 1px solid #e9ecef;
        }

        .total-row:last-child {
            border-bottom: none;
        }

        .total-label, .total-value {
            display: table-cell;
            font-size: 7px;
        }

        .total-value {
            text-align: right;
        }

        .total-final {
            background: linear-gradient(135deg, #E6C65B 0%, #B88A2E 100%);
            color: white;
            font-weight: bold;
            font-size: 9px;
            padding: 6px 8px;
        }

        /* Pied de page - optimisé A4 */
        .footer {
            margin-top: 12px;
            padding-top: 10px;
            border-top: 1px solid #B88A2E;
        }

        .footer-row {
            display: table;
            width: 100%;
        }

        .footer-col {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 6px;
        }

        .footer-title {
            color: #B88A2E;
            font-size: 6px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .footer-text {
            font-size: 6px;
            color: #6c757d;
            line-height: 1.2;
        }

        /* Section signature - optimisé A4 */
        .signature-section {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #e9ecef;
        }

        .signature-row {
            text-align: right;
            padding-right: 30px;
        }

        .signature-title {
            color: #B88A2E;
            font-size: 6px;
            font-weight: bold;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .signature-line {
            border-bottom: 1px solid #2A2A2A;
            width: 100px;
            margin-left: auto;
            margin-bottom: 3px;
            position: relative;
        }

        .signature-line::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #B88A2E, transparent);
        }

        .signature-text {
            font-size: 5px;
            color: #6c757d;
            font-style: italic;
        }

        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête professionnel -->
        <div class="header">
            <div class="header-content">
                <div class="header-left">
                    <div class="company-name">{{ config('app.name') }}</div>
                    <div class="company-tagline">Électroménager & Électronique de Qualité</div>
                </div>
                <div class="header-right">
                    <div class="invoice-badge">FACTURE</div>
                    <div class="invoice-number">
                        Date: {{ $date ?? now()->format('d/m/Y') }}<br>
                        N°: INV-{{ strtoupper(substr(md5(now()->timestamp), 0, 8)) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Informations client -->
        <div class="info-section">
            <div class="info-row">
                <div class="info-col">
                    <div class="info-title">Facturé à</div>
                    <div class="info-text">
                        <strong>{{ auth()->user()->name ?? 'Client' }}</strong><br>
                        {{ auth()->user()->email ?? '' }}
                    </div>
                </div>
                <div class="info-col">
                    <div class="info-title">Détails de paiement</div>
                    <div class="info-text">
                        <span class="payment-badge">En attente</span><br>
                        Paiement à la livraison
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des produits -->
        <table>
            <thead>
                <tr>
                    <th style="width: 40%;">Produit</th>
                    <th style="width: 20%;">Marque</th>
                    <th style="width: 10%;" class="text-center">Qté</th>
                    <th style="width: 15%;" class="text-end">P.U (FCFA)</th>
                    <th style="width: 15%;" class="text-end">Total (FCFA)</th>
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
                        <td class="text-end">{{ number_format($item->produit->prix, 0, ',', ' ') }}</td>
                        <td class="text-end text-bold">{{ number_format($item->produit->prix * $item->quantite, 0, ',', ' ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Section totaux -->
        <div class="totals-section">
            <div class="total-row">
                <span class="total-label">Total:</span>
                <span class="total-value">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="total-row total-final">
                <span class="total-label">Total à payer:</span>
                <span class="total-value">{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-row">
                <div class="footer-col">
                    <div class="footer-title">Conditions de paiement</div>
                    <div class="footer-text">
                        Paiement à la livraison. Garantie satisfait ou remboursé sous 14 jours.
                    </div>
                </div>
                <div class="footer-col" style="text-align: right;">
                    <div class="footer-title">Merci pour votre confiance !</div>
                    <div class="footer-text">
                        Pour toute question, contactez notre service client.
                    </div>
                </div>
            </div>
        </div>

        <!-- Section signature -->
        <div class="signature-section">
            <div class="signature-row">
                <div class="signature-title">Signature du client</div>
                <div class="signature-line"></div>
                <div class="signature-text">Lu et approuvé</div>
            </div>
        </div>
    </div>
</body>
</html>
