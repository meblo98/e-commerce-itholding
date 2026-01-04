<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Categorie;
use App\Models\Marque;

class AdminProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::with('categorie', 'marque')->orderBy('nom')->get();
        return view('admin.view.produit-list', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        $marques = Marque::all();
        return view('admin.view.produit-add', compact('categories', 'marques'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required|exists:categories,id',
            'marque_id' => 'nullable|exists:marques,id',
            'active' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
        ]);

        $imagePath = null;

        // Créer le produit avec la première image comme image principale
        $produit = Produit::create([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
            'image' => 'placeholder.png',
            'categorie_id' => $request->input('categorie_id'),
            'marque_id' => $request->filled('marque_id') ? $request->input('marque_id') : null,
            'active' => $request->has('active') ? 1 : 0,
            'stock' => $request->input('stock'),
            'prix' => $request->input('prix'),
        ]);

        // Stocker toutes les images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $chemin = $file->store('produits', 'public');

                // La première image devient l'image principale du produit
                if ($index === 0) {
                    $produit->update(['image' => $chemin]);
                }

                Image::create([
                    'produit_id' => $produit->id,
                    'chemin' => $chemin,
                    'ordre' => $index,
                ]);
            }
        }

        return redirect()->route('admin.produits.index')->with('success', 'Produit créé avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        $categories = Categorie::all();
        $marques = Marque::all();
        return view('admin.view.produit-edit', compact('produit', 'categories', 'marques'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required|exists:categories,id',
            'marque_id' => 'nullable|exists:marques,id',
            'active' => 'nullable|boolean',
            'stock' => 'required|integer|min:0',
            'prix' => 'required|numeric|min:0',
        ]);

        $produit->update([
            'nom' => $request->input('nom'),
            'description' => $request->input('description'),
            'categorie_id' => $request->input('categorie_id'),
            'marque_id' => $request->filled('marque_id') ? $request->input('marque_id') : null,
            'active' => $request->has('active') ? 1 : 0,
            'stock' => $request->input('stock'),
            'prix' => $request->input('prix'),
        ]);

        // Ajouter les nouvelles images
        if ($request->hasFile('images')) {
            $maxOrdre = $produit->images()->max('ordre') ?? -1;
            foreach ($request->file('images') as $index => $file) {
                $chemin = $file->store('produits', 'public');
                
                // Si l'image principale est un placeholder, on utilise la première nouvelle image
                if ($produit->image === 'placeholder.png' && $index === 0) {
                    $produit->update(['image' => $chemin]);
                }

                Image::create([
                    'produit_id' => $produit->id,
                    'chemin' => $chemin,
                    'ordre' => $maxOrdre + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        try {
            // Supprimer fichiers des images si présents
            foreach ($produit->images()->get() as $image) {
                try {
                    Storage::disk('public')->delete($image->chemin);
                } catch (\Throwable $e) {
                    // Continuer même si le fichier n'existe plus
                    Log::warning('Suppression fichier image échouée', ['image_id' => $image->id, 'chemin' => $image->chemin, 'error' => $e->getMessage()]);
                }
            }
            // Supprimer les enregistrements d'images en base
            $produit->images()->delete();
            
            // Supprimer l'image principale si présente
            if ($produit->image && $produit->image !== 'placeholder.png') {
                try {
                    Storage::disk('public')->delete($produit->image);
                } catch (\Throwable $e) {
                    Log::warning('Suppression image principale échouée', ['produit_id' => $produit->id, 'image' => $produit->image, 'error' => $e->getMessage()]);
                }
            }
            
            // Supprimer le produit
            $produit->delete();
            
            Log::info('Produit supprimé avec succès', ['produit_id' => $produit->id, 'nom' => $produit->nom]);
            return redirect()->route('admin.produits.index')->with('success', 'Produit supprimé avec succès.');
        } catch (\Throwable $e) {
            Log::error('Suppression produit échouée', ['produit_id' => $produit->id, 'error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->route('admin.produits.index')->with('error', 'La suppression a échoué : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified image from storage.
     */
    public function deleteImage(Image $image)
    {
        Storage::disk('public')->delete($image->chemin);
        $image->delete();
        return back()->with('success', 'Image supprimée avec succès.');
    }
}
