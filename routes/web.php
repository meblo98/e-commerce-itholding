<?php

use App\Http\Controllers\Admin\AdminCategorieController;
use App\Http\Controllers\Admin\AdminCommandeController;
use App\Http\Controllers\Admin\AdminMarqueController;
use App\Http\Controllers\Admin\AdminProduitController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Accueil: mélange de produits via le contrôleur
Route::get('/', [ProduitController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

// Affiche la page shop via le controller pour gérer la pagination et les filtres
Route::get('/produits', [ProduitController::class, 'shop']);


// La route vers le détail d'un produit est gérée par le contrôleur
// (définie plus bas). Suppression de la closure pour éviter un conflit
// et s'assurer que la vue reçoit bien la variable `$produit`.

//route not found
Route::fallback(function () {
    return view('notfound');
});

//routes categories
Route::get('/categories', [CategorieController::class, 'index'])->name('index');
Route::get('/categorie/{categorie}', [CategorieController::class, 'show']);

//routes marques
Route::get('/marques', [MarqueController::class, 'index']);
Route::get('/marque/{marque}', [MarqueController::class, 'show']);

//routes produits
Route::get('/list-produits', [ProduitController::class, 'index']);
Route::get('/produit/{id}', [ProduitController::class, 'show']);
//filter produits by marque
Route::get('/produits/marque/{marque}', [ProduitController::class, 'filterByMarque']);
Route::get('/produits/marque-product/{marque}', [ProduitController::class, 'filterByMarqueAllProducts']);

//filter produits by categorie
Route::get('/produits/categorie/{categorie}', [ProduitController::class, 'filterByCategorie']);

// Routes panier
Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
Route::post('/panier/add/{produit}', [PanierController::class, 'add'])->name('panier.add');
Route::put('/panier/update/{panier}', [PanierController::class, 'update'])->name('panier.update');
Route::delete('/panier/remove/{panier}', [PanierController::class, 'remove'])->name('panier.remove');
Route::delete('/panier/clear', [PanierController::class, 'clear'])->name('panier.clear');
Route::get('/panier/whatsapp', [PanierController::class, 'whatsapp'])->name('panier.whatsapp');
Route::get('/panier/facture', [PanierController::class, 'facture'])->name('panier.facture');
Route::get('/checkout', [PanierController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/place-order', [PanierController::class, 'placeOrder'])->name('place.order')->middleware('auth');

// Espace Client : Mes commandes
Route::middleware(['auth'])->group(function () {
    Route::get('/mes-commandes', [\App\Http\Controllers\CommandeController::class, 'index'])->name('commandes.index');
    Route::get('/ma-commande/{commande}', [\App\Http\Controllers\CommandeController::class, 'show'])->name('commandes.show');
});



//Route dashboard
Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    // Tableau de bord principal
    Route::get('/admin', [LoginController::class, 'me'])->name('admin');

    // Produits (admin)
    Route::get('/produit-list', [AdminProduitController::class, 'index'])->name('admin.produits.index');
    Route::get('/produit-add', [AdminProduitController::class, 'create'])->name('admin.produits.create');
    Route::post('/produit-add', [AdminProduitController::class, 'store'])->name('admin.produits.store');
    Route::get('/produit-edit/{produit}', [AdminProduitController::class, 'edit'])->name('admin.produits.edit');
    Route::put('/produit-edit/{produit}', [AdminProduitController::class, 'update'])->name('admin.produits.update');
    // Alias de suppression si une requête DELETE arrive par erreur sur l'URL d'édition
    Route::delete('/produit-edit/{produit}', [AdminProduitController::class, 'destroy']);
    Route::delete('/produit/{produit}', [AdminProduitController::class, 'destroy'])->name('admin.produits.destroy');
    Route::get('/produit-details', function () {
        return view('Admin.view.produit-details');
    });
    Route::delete('/image/{image}', [AdminProduitController::class, 'deleteImage'])->name('admin.produits.image.delete');

    // Catégories (admin)
    Route::get('/category-list', [AdminCategorieController::class, 'index'])->name('admin.categories.index');
    Route::get('/category-add', [AdminCategorieController::class, 'create'])->name('admin.categories.create');
    Route::post('/category-add', [AdminCategorieController::class, 'store'])->name('admin.categories.store');
    Route::get('/category-edit/{categorie}', [AdminCategorieController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/category-edit/{categorie}', [AdminCategorieController::class, 'update'])->name('admin.categories.update');
    Route::delete('/category/{categorie}', [AdminCategorieController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('/category-detail/{categorie}', [AdminCategorieController::class, 'show'])->name('admin.categories.show');

    // Commandes (admin)
    Route::get('/commande-list', [AdminCommandeController::class, 'index'])->name('admin.commandes.index');
    Route::get('/commande/{commande}', [AdminCommandeController::class, 'show'])->name('admin.commandes.show');
    Route::put('/commande/{commande}/status', [AdminCommandeController::class, 'updateStatus'])->name('admin.commandes.updateStatus');
    Route::put('/commande/{commande}/tracking', [AdminCommandeController::class, 'updateTracking'])->name('admin.commandes.updateTracking');
    Route::delete('/commande/{commande}', [AdminCommandeController::class, 'destroy'])->name('admin.commandes.destroy');
    Route::get('/commandes/export', [AdminCommandeController::class, 'export'])->name('admin.commandes.export');

    // Utilisateurs (admin)
    Route::get('/user-list', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/user-add', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/user-add', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/user-edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/user-edit/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // Marques (admin)
    Route::get('/marque-list', [AdminMarqueController::class, 'index'])->name('admin.marques.index');
    Route::get('/marque-add', [AdminMarqueController::class, 'create'])->name('admin.marques.create');
    Route::post('/marque-add', [AdminMarqueController::class, 'store'])->name('admin.marques.store');
    Route::get('/marque-edit/{marque}', [AdminMarqueController::class, 'edit'])->name('admin.marques.edit');
    Route::put('/marque-edit/{marque}', [AdminMarqueController::class, 'update'])->name('admin.marques.update');
    Route::delete('/marque/{marque}', [AdminMarqueController::class, 'destroy'])->name('admin.marques.destroy');

    // Rapports (admin)
    Route::get('/rapport', function () {
        return view('admin.view.rapport');
    });

    // Paramètres (admin)
    Route::get('/settings', function () {
        return view('admin.view.parametre');
    });
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])
        ->name('settings.password.update');
});

// Route protégée par le groupe auth ci-dessus

// Authentification Client
Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showClientLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
    
    Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('register');
    Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');
});

// Authentification Admin (Redirection si nécessaire ou page dédiée)
Route::get('/admin/login', [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('admin.login')->middleware('guest');

Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'logout'])->name('logout')->middleware('auth');

// routes admin protégées ci-dessus

