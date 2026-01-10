<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    /**
     * Liste des commandes de l'utilisateur
     */
    public function index()
    {
        $commandes = Commande::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('commandes.index', compact('commandes'));
    }

    /**
     * Détails d'une commande
     */
    public function show(Commande $commande)
    {
        // Vérifier que la commande appartient à l'utilisateur
        if ($commande->user_id !== Auth::id()) {
            abort(403);
        }

        $commande->load('items.produit');

        return view('commandes.show', compact('commande'));
    }
}
