<x-mail::message>
# Merci pour votre commande !

Bonjour {{ $commande->nom_client }},

Votre commande **#{{ $commande->numero_commande }}** a été enregistrée avec succès.

## Récapitulatif de la commande
- **Numéro :** #{{ $commande->numero_commande }}
- **Date :** {{ $commande->created_at->format('d/m/Y') }}
- **Total :** {{ number_format($commande->total, 0, ',', ' ') }} FCFA
- **Méthode de paiement :** {{ $commande->methode_paiement }}

## Adresse de livraison
{{ $commande->adresse_livraison }}

<x-mail::button :url="route('commandes.show', $commande->id)">
Suivre ma commande
</x-mail::button>

Nous vous contacterons dès que votre commande sera expédiée.

Merci de votre confiance,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
