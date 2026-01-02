<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class AdminCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::withCount('produits')->orderBy('titre')->get();
        return view('admin.view.category-list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.view.category-add');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        Categorie::create([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        $produits = $categorie->produits()->paginate(12);
        return view('admin.view.category-detail', compact('categorie', 'produits'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('admin.view.category-edit', compact('categorie'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $categorie->update([
            'titre' => $request->input('titre'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        if ($categorie->produits()->count() > 0) {
            return back()->withErrors('Impossible de supprimer cette catégorie car elle contient des produits.');
        }
        $categorie->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée avec succès.');
    }
}
