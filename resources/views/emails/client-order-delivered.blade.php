<x-mail::message>
# Votre commande a été livrée !

Bonjour {{ $commande->nom_client }},

Nous avons le plaisir de vous informer que votre commande **#{{ $commande->numero_commande }}** a été livrée avec succès.

## Détails de la livraison
- **Numéro :** #{{ $commande->numero_commande }}
- **Date de livraison :** {{ now()->format('d/m/Y') }}
- **Total :** {{ number_format($commande->total, 0, ',', ' ') }} FCFA

Nous espérons que vous êtes satisfait de vos achats chez **Club Mobile Electronics**.

<x-mail::button :url="route('commandes.show', $commande->id)">
Voir les détails de ma commande
</x-mail::button>

Merci de votre fidélité !<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
