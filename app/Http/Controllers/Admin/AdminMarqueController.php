<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marques = Marque::withCount('produits')->orderBy('nom')->get();
        return view('admin.view.marque-list', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.view.marque-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('marques', 'public');
        }

        Marque::create([
            'nom' => $request->input('nom'),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.marques.index')->with('success', 'Marque créée avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marque $marque)
    {
        return view('admin.view.marque-edit', compact('marque'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Marque $marque)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $logoPath = $marque->logo;
        if ($request->hasFile('logo')) {
            // Supprimer l'ancien logo
            if ($marque->logo) {
                Storage::disk('public')->delete($marque->logo);
            }
            $logoPath = $request->file('logo')->store('marques', 'public');
        }

        $marque->update([
            'nom' => $request->input('nom'),
            'logo' => $logoPath,
        ]);

        return redirect()->route('admin.marques.index')->with('success', 'Marque mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marque $marque)
    {
        if ($marque->produits()->count() > 0) {
            return back()->withErrors('Impossible de supprimer cette marque car elle contient des produits.');
        }

        // Supprimer le logo
        if ($marque->logo) {
            Storage::disk('public')->delete($marque->logo);
        }

        $marque->delete();
        return redirect()->route('admin.marques.index')->with('success', 'Marque supprimée avec succès.');
    }
}
