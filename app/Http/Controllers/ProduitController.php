<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Produit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Meilleures Offres: mix multi-catégories (max 3 par catégorie, 24 au total)
            $bestOffers = Produit::with(['categorie', 'marque'])
                ->where('active', true)
                ->orderByDesc('id')
                ->take(200)
                ->get()
                ->groupBy('categorie_id')
                ->flatMap(function ($items) {
                    return $items->take(3);
                })
                ->shuffle()
                ->take(24)
                ->values();

            // Bloc "Digital & Electronics": liste élargie sans indexation par catégorie
            $produitsAll = Produit::with(['categorie', 'marque'])
                ->where('active', true)
                ->orderByDesc('id')
                ->take(40)
                ->get();

            // Trois catégories avec produits (pour les onglets en haut)
            $categoriesThree = Categorie::with(['produits' => function ($q) {
                    $q->orderByDesc('id')->take(10);
                }])
                ->whereHas('produits')
                ->orderBy('titre')
                ->take(3)
                ->get();

            // Liste complète des catégories avec un échantillon de produits
            $categories = Categorie::with(['produits' => function ($q) {
                    $q->orderByDesc('id')->take(10);
                }])
                ->orderBy('titre')
                ->get();

            // Marques pour le carrousel de logos
            $marques = Marque::orderBy('nom')->get();

            return view('index', compact('bestOffers', 'produitsAll', 'marques', 'categories', 'categoriesThree'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate and store the new product
            $produit = Produit::create();
            $produit->nom = $request->input('nom');
            $produit->description = $request->input('description');
            if ($request->hasFile('image')) {
                $produit->image = $this->storeImage($request->file('image'));
            }
            $produit->categorie_id = $request->input('categorie_id');
            $produit->marque_id = $request->input('marque_id');
            $produit->active = $request->input('active');
            $produit->stock = $request->input('stock');
            $produit->save();
            return response()->json($produit, 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $produit = Produit::with(['categorie', 'marque'])->findOrFail($id);
            return view('detail-product', compact('produit'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        try {
            $produit->nom = $request->input('nom');
            $produit->description = $request->input('description');
            if ($request->hasFile('image')) {
                $produit->image = $this->storeImage($request->file('image'));
            }
            $produit->categorie_id = $request->input('categorie_id');
            $produit->marque_id = $request->input('marque_id');
            $produit->active = $request->input('active');
            $produit->stock = $request->input('stock');
            $produit->save();
            return response()->json($produit, 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        try {
            $produit->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $produits = Produit::where('nom', 'LIKE', "%$query%")
                ->orWhere('description', 'LIKE', "%$query%")
                ->with(['categorie', 'marque'])
                ->get();
            return view('index', compact('produits'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function filterByCategorie($categorieId)
    {
        try {
            $categorie = Categorie::findOrFail($categorieId);
            $produits = Produit::where('categorie_id', $categorieId)
                ->with(['categorie', 'marque'])
                ->take(5) // récupère seulement les 5 premiers
                ->get();
            return view('index', compact('produits'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function filterByMarque($marqueId)
    {
        try {
            $marque = Marque::findOrFail($marqueId);
            $produits = Produit::where('marque_id', $marqueId)
                ->with(['categorie', 'marque'])
                ->take(10) // récupère seulement les 10 premiers
                ->get();
            return view('index', compact('produits'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function filterByMarqueAllProducts($marqueId)
    {
        $marque = Marque::findOrFail($marqueId);

        $produits = Produit::where('marque_id', $marqueId)
            ->with(['categorie', 'marque'])
            ->paginate(12); // pagination

        return view('shop', compact('produits', 'marque'));
    }


    public function storeImage($image)
    {
        return $image->store('produits', 'public');
    }

    public function shop(Request $request)
    {
        // Récupérer TOUTES les catégories disponibles (pour le filtre)
        // Priorité aux catégories avec produits, puis les autres
        $categoriesWithProducts = Categorie::whereHas('produits')
            ->orderBy('titre')
            ->get();
        
        $categoriesWithoutProducts = Categorie::whereDoesntHave('produits')
            ->orderBy('titre')
            ->get();
        
        $categories = $categoriesWithProducts->merge($categoriesWithoutProducts);

        // Catégorie sélectionnée via ?cat=ID (optionnelle)
        $selectedCategoryId = $request->query('cat');

        // Mix de produits variés à afficher en premier (avant les filtres)
        $productsPreview = Produit::with(['categorie', 'marque'])
            ->where('active', true)
            ->orderByDesc('id')
            ->take(200)
            ->get()
            ->groupBy('categorie_id')
            ->flatMap(function ($items) {
                return $items->take(3);
            })
            ->shuffle()
            ->take(30)
            ->values();

        // Base query: tous les produits, avec relations
        $query = Produit::with(['categorie', 'marque']);

        // Si une catégorie est sélectionnée, on filtre
        if (!empty($selectedCategoryId)) {
            $query->where('categorie_id', $selectedCategoryId);
        }

        // Pagination pour la vue shop
        $produits = $query->orderByDesc('id')->paginate(12)->withQueryString();

        // Debug temporaire
        \Log::info('Shop - Selected Cat: ' . ($selectedCategoryId ?? 'null') . ', Total produits: ' . $produits->total());

        return view('shop', compact('categories', 'productsPreview', 'produits', 'selectedCategoryId'));
    }
}
