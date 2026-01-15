<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\CommandeItem;
use App\Mail\ClientOrderDeliveredNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminCommandeController extends Controller
{
    /**
     * Afficher la liste des commandes
     */
    public function index(Request $request)
    {
        $query = Commande::with(['user', 'items'])->orderBy('created_at', 'desc');

        // Filtrage par statut
        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }

        // Recherche
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('numero_commande', 'like', "%{$search}%")
                  ->orWhere('nom_client', 'like', "%{$search}%")
                  ->orWhere('email_client', 'like', "%{$search}%")
                  ->orWhere('telephone_client', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $commandes = $query->paginate(15);

        // Statistiques
        $stats = [
            'total' => Commande::count(),
            'en_attente' => Commande::where('statut', 'en_attente')->count(),
            'confirmee' => Commande::where('statut', 'confirmee')->count(),
            'en_preparation' => Commande::where('statut', 'en_preparation')->count(),
            'expediee' => Commande::where('statut', 'expediee')->count(),
            'livree' => Commande::where('statut', 'livree')->count(),
            'annulee' => Commande::where('statut', 'annulee')->count(),
        ];

        return view('admin.view.orders-list', compact('commandes', 'stats'));
    }

    /**
     * Afficher les détails d'une commande
     */
    public function show(Commande $commande)
    {
        $commande->load(['user', 'items.produit']);
        return view('admin.view.orders-details', compact('commande'));
    }

    /**
     * Mettre à jour le statut d'une commande
     */
    public function updateStatus(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,en_preparation,expediee,livree,annulee',
        ]);

        $commande->update([
            'statut' => $request->statut,
        ]);

        // Envoyer un email au client si la commande est livrée
        if ($request->statut === 'livree') {
            try {
                Mail::to($commande->email_client)->send(new ClientOrderDeliveredNotification($commande));
            } catch (\Exception $e) {
                \Log::error("Erreur envoi email livraison : " . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Statut de la commande mis à jour avec succès.');
    }

    /**
     * Mettre à jour le numéro de tracking
     */
    public function updateTracking(Request $request, Commande $commande)
    {
        $request->validate([
            'numero_tracking' => 'nullable|string|max:255',
        ]);

        $commande->update([
            'numero_tracking' => $request->numero_tracking,
        ]);

        return redirect()->back()->with('success', 'Numéro de tracking mis à jour avec succès.');
    }

    /**
     * Supprimer une commande
     */
    public function destroy(Commande $commande)
    {
        $commande->delete();
        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée avec succès.');
    }

    /**
     * Exporter les commandes en CSV
     */
    public function export(Request $request)
    {
        $query = Commande::with(['user', 'items'])->orderBy('created_at', 'desc');

        if ($request->has('statut') && $request->statut != '') {
            $query->where('statut', $request->statut);
        }

        $commandes = $query->get();

        $filename = 'commandes_' . date('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($commandes) {
            $file = fopen('php://output', 'w');
            
            // En-têtes
            fputcsv($file, [
                'Numéro',
                'Date',
                'Client',
                'Email',
                'Téléphone',
                'Montant Total',
                'Statut',
                'Statut Paiement',
                'Méthode Paiement',
            ]);

            // Données
            foreach ($commandes as $commande) {
                fputcsv($file, [
                    $commande->numero_commande,
                    $commande->created_at->format('d/m/Y H:i'),
                    $commande->nom_client_complet,
                    $commande->email_client ?? $commande->user?->email,
                    $commande->telephone_client,
                    number_format($commande->total, 2) . ' FCFA',
                    $commande->statut_libelle,
                    $commande->statut_paiement,
                    $commande->methode_paiement,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
