<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\Panier;
use App\Models\Produit;
use App\Models\User;
use App\Mail\AdminOrderNotification;
use App\Mail\ClientOrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PanierController extends Controller
{
    public function index()
    {
        $panierItems = collect();
        $total = 0;

        if (Auth::check()) {
            // Utilisateur connecté
            $panierItems = Panier::with('produit.marque')->where('user_id', Auth::id())->get();
            $total = $panierItems->sum(function ($item) {
                return $item->produit->prix * $item->quantite;
            });
        } else {
            // Utilisateur non connecté - utiliser la session
            $panier = Session::get('panier', []);
            foreach ($panier as $produitId => $quantite) {
                $produit = Produit::with('marque')->find($produitId);
                if ($produit) {
                    $panierItems->push((object)[
                        'id' => $produitId,
                        'produit' => $produit,
                        'quantite' => $quantite,
                    ]);
                    $total += $produit->prix * $quantite;
                }
            }
        }
        return view('panier.index', compact('panierItems', 'total'));
    }

    public function add(Request $request, Produit $produit)
    {
        if (Auth::check()) {
            // Utilisateur connecté - sauvegarder en BD
            $panierItem = Panier::where('produit_id', $produit->id)->where('user_id', Auth::id())->first();

            if ($panierItem) {
                $panierItem->quantite += 1;
                $panierItem->save();
            } else {
                Panier::create([
                    'produit_id' => $produit->id,
                    'quantite' => 1,
                    'user_id' => Auth::id(),
                ]);
            }
        } else {
            // Utilisateur non connecté - sauvegarder en session
            $panier = Session::get('panier', []);
            if (isset($panier[$produit->id])) {
                $panier[$produit->id]++;
            } else {
                $panier[$produit->id] = 1;
            }
            Session::put('panier', $panier);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, $panierId)
    {
        $request->validate([
            'quantite' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $panier = Panier::where('user_id', Auth::id())->where('id', $panierId)->firstOrFail();
            $panier->quantite = $request->input('quantite');
            $panier->save();
        } else {
            $panier = Session::get('panier', []);
            if (isset($panier[$panierId])) {
                $panier[$panierId] = $request->input('quantite');
                Session::put('panier', $panier);
            }
        }

        return redirect()->back()->with('success', 'Quantité mise à jour.');
    }

    public function remove($panierId)
    {
        if (Auth::check()) {
            $panier = Panier::where('user_id', Auth::id())->where('id', $panierId)->firstOrFail();
            $panier->delete();
        } else {
            $panier = Session::get('panier', []);
            unset($panier[$panierId]);
            Session::put('panier', $panier);
        }
        return redirect()->back()->with('success', 'Produit retiré du panier.');
    }

    public function clear()
    {
        if (Auth::check()) {
            Panier::where('user_id', Auth::id())->delete();
        } else {
            Session::forget('panier');
        }
        return redirect()->back()->with('success', 'Panier vidé.');
    }

    public function whatsapp()
    {
        $panierItems = collect();
        $total = 0;

        if (Auth::check()) {
            $panierItems = Panier::with('produit.marque')->where('user_id', Auth::id())->get();
            $total = $panierItems->sum(function ($item) {
                return $item->produit->prix * $item->quantite;
            });
        } else {
            $panier = Session::get('panier', []);
            foreach ($panier as $produitId => $quantite) {
                $produit = Produit::with('marque')->find($produitId);
                if ($produit) {
                    $panierItems->push((object) [
                        'produit' => $produit,
                        'quantite' => $quantite,
                    ]);
                    $total += $produit->prix * $quantite;
                }
            }
        }

        if ($panierItems->isEmpty()) {
            return redirect()->back()->with('error', 'Le panier est vide.');
        }

        // Générer un PDF de facture et l'héberger publiquement
        $pdf = Pdf::loadView('panier.invoice', [
            'panierItems' => $panierItems,
            'total' => $total,
            'date' => now()->format('d/m/Y')
        ]);

        $dir = 'factures';
        $filename = 'facture_' . now()->format('Ymd_His') . '.pdf';
        $path = $dir . '/' . $filename;

        Storage::disk('public')->put($path, $pdf->output());
        $publicUrl = asset('storage/' . $path);

        // Message WhatsApp contenant uniquement le lien de la facture
        $message = "Bonjour, voici la facture de ma commande :\n" . $publicUrl . "\n\nMerci de confirmer cette commande.";

        $whatsappNumber = '+221773162001';
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . urlencode($message);

        return redirect($whatsappUrl);
    }


    public function facture()
    {
        $panierItems = collect();
        $total = 0;

        if (Auth::check()) {
            $panierItems = Panier::with('produit.marque')->where('user_id', Auth::id())->get();
            $total = $panierItems->sum(function ($item) {
                return $item->produit->prix * $item->quantite;
            });
        } else {
            $panier = Session::get('panier', []);
            foreach ($panier as $produitId => $quantite) {
                $produit = Produit::with('marque')->find($produitId);
                if ($produit) {
                    $panierItems->push((object) [
                        'produit'   => $produit,
                        'quantite'  => $quantite,
                    ]);
                    $total += $produit->prix * $quantite;
                }
            }
        }

        if ($panierItems->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Le panier est vide.');
        }

        return view('panier.facture', compact('panierItems', 'total'));
    }

    public function checkout()
    {
        $panierItems = Panier::with('produit.marque')->where('user_id', Auth::id())->get();
        if ($panierItems->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        $total = $panierItems->sum(function ($item) {
            return $item->produit->prix * $item->quantite;
        });

        return view('panier.checkout', compact('panierItems', 'total'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255',
            'email_client' => 'required|email|max:255',
            'telephone_client' => 'required|string|max:255',
            'adresse_livraison' => 'required|string',
            'methode_paiement' => 'required|string',
        ]);

        $panierItems = Panier::with('produit')->where('user_id', Auth::id())->get();

        if ($panierItems->isEmpty()) {
            return redirect()->route('panier.index')->with('error', 'Votre panier est vide.');
        }

        $total = $panierItems->sum(function ($item) {
            return $item->produit->prix * $item->quantite;
        });

        try {
            DB::beginTransaction();

            $commande = Commande::create([
                'numero_commande' => Commande::generateNumeroCommande(),
                'user_id' => Auth::id(),
                'nom_client' => $request->nom_client,
                'email_client' => $request->email_client,
                'telephone_client' => $request->telephone_client,
                'adresse_livraison' => $request->adresse_livraison,
                'sous_total' => $total,
                'total' => $total, // On pourra ajouter des frais de livraison plus tard
                'statut' => 'en_attente',
                'statut_paiement' => 'en_attente',
                'methode_paiement' => $request->methode_paiement,
            ]);

            foreach ($panierItems as $item) {
                CommandeItem::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $item->produit_id,
                    'nom_produit' => $item->produit->nom,
                    'marque_produit' => $item->produit->marque?->nom,
                    'prix_unitaire' => $item->produit->prix,
                    'quantite' => $item->quantite,
                    'sous_total' => $item->produit->prix * $item->quantite,
                ]);
            }

            // Vider le panier
            Panier::where('user_id', Auth::id())->delete();

            DB::commit();

            // Envoyer les emails
            try {
                // Email à l'admin
                $admin = User::where('role', 'admin')->first();
                if ($admin) {
                    Mail::to($admin->email)->send(new AdminOrderNotification($commande));
                }

                // Email au client
                Mail::to($commande->email_client)->send(new ClientOrderNotification($commande));
                
            } catch (\Exception $e) {
                // On log l'erreur mais on ne bloque pas l'utilisateur
                \Log::error("Erreur envoi email : " . $e->getMessage());
            }

            return view('panier.success', compact('commande'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Une erreur est survenue lors du passage de la commande : ' . $e->getMessage());
        }
    }
}
