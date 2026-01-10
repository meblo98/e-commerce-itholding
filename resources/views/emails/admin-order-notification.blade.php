<x-mail::message>
# Nouvelle commande reçue !

Une nouvelle commande a été passée sur votre site **Club Mobile Electronics**.

## Détails de la commande
- **Numéro :** #{{ $commande->numero_commande }}
- **Client :** {{ $commande->nom_client }}
- **Email :** {{ $commande->email_client }}
- **Téléphone :** {{ $commande->telephone_client }}
- **Total :** {{ number_format($commande->total, 0, ',', ' ') }} FCFA
- **Méthode de paiement :** {{ $commande->methode_paiement }}

## Adresse de livraison
{{ $commande->adresse_livraison }}

<x-mail::button :url="route('admin.commandes.show', $commande->id)">
Voir la commande dans l'admin
</x-mail::button>

Merci,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>
