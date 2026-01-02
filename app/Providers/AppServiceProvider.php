<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Categorie;
use App\Models\Marque;
use App\Models\Produit;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('categories', Categorie::all());
        });

        //pour les marques
        View::composer('*', function ($view) {
            $view->with('marques', Marque::all());
        });

        //recup marque Samsung  avec les produits
        View::composer('*', function ($view) {
            $view->with('marquesProduits', Marque::with('produits')->get());
        });

        //send one marque to all views
        View::composer('*', function ($view) {
            $view->with('marque', Marque::first());
        });

        View::composer('index', function ($view) {
            $view->with([
                'produits' => Produit::take(10)->get(),
                'marques' => Marque::all(),
            ]);
        });

        //display 3 categories
        View::composer('index', function ($view) {
            $categoriesThree = Categorie::take(3)->get()->map(function ($categorie) {
                // Récupérer les 5 premiers produits pour chaque catégorie
                $categorie->produits = $categorie->produits()->take(5)->get();
                return $categorie;
            });

            $view->with('categoriesThree', $categoriesThree);
        });

        View::composer('digital-electronics', function ($view) {
            $categories = Categorie::whereIn('titre', ['Téléviseurs', 'Climatiseurs'])
                ->with(['produits' => function ($query) {
                    $query->take(5); // Limite de produits par catégorie
                }])->get();

            $allProducts = Produit::whereHas('categorie', function ($q) {
                $q->whereIn('titre', ['Téléviseurs', 'Climatiseurs']);
            })->take(5)->get();

            $view->with([
                'categories' => $categories,
                'allProducts' => $allProducts
            ]);
        });

        //send all the products by marque
        View::composer('shop', function ($view) {
            $allProducts = Produit::all();
            $view->with([
                'allProducts' => $allProducts
            ]);
        });

        View::composer('shop', function ($view) {
            // Récupération des catégories concernées
            $categories = Categorie::whereIn('titre', ['Téléviseurs', 'Climatiseurs'])
                ->with('produits')
                ->get();

            // Catégorie sélectionnée via ?cat=ID ou première catégorie par défaut
            $selectedCategoryId = request()->query('cat', $categories->first()->id ?? null);

            // Fournir un paginator au lieu d'une Collection pour que la vue
            // puisse utiliser les méthodes de pagination (onFirstPage, url, ...)
            $produits = Produit::where('categorie_id', $selectedCategoryId)
                ->where('active', true)
                ->paginate(12)
                ->appends(['cat' => $selectedCategoryId]);

            $view->with([
                'categories' => $categories,
                'produits' => $produits,
                'selectedCategoryId' => $selectedCategoryId,
            ]);
        });

    }
}
