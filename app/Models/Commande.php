<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero_commande',
        'user_id',
        'nom_client',
        'email_client',
        'telephone_client',
        'adresse_livraison',
        'sous_total',
        'frais_livraison',
        'total',
        'statut',
        'statut_paiement',
        'methode_paiement',
        'numero_tracking',
        'notes',
    ];

    protected $casts = [
        'sous_total' => 'decimal:2',
        'frais_livraison' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Relation avec l'utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec les items de la commande
     */
    public function items()
    {
        return $this->hasMany(CommandeItem::class);
    }

    /**
     * Générer un numéro de commande unique
     */
    public static function generateNumeroCommande()
    {
        do {
            $numero = 'CMD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('numero_commande', $numero)->exists());

        return $numero;
    }

    /**
     * Obtenir le badge de statut
     */
    public function getStatutBadgeAttribute()
    {
        $badges = [
            'en_attente' => 'warning',
            'confirmee' => 'info',
            'en_preparation' => 'primary',
            'expediee' => 'secondary',
            'livree' => 'success',
            'annulee' => 'danger',
        ];

        return $badges[$this->statut] ?? 'secondary';
    }

    /**
     * Obtenir le libellé du statut
     */
    public function getStatutLibelleAttribute()
    {
        $libelles = [
            'en_attente' => 'En attente',
            'confirmee' => 'Confirmée',
            'en_preparation' => 'En préparation',
            'expediee' => 'Expédiée',
            'livree' => 'Livrée',
            'annulee' => 'Annulée',
        ];

        return $libelles[$this->statut] ?? $this->statut;
    }

    /**
     * Obtenir le nom du client
     */
    public function getNomClientCompletAttribute()
    {
        if ($this->user) {
            return $this->user->name . ' ' . ($this->user->lastname ?? '');
        }
        return $this->nom_client ?? 'Client invité';
    }
}
