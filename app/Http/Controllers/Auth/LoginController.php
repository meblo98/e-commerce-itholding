<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('admin.view.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user && $user->role === 'admin') {
                return redirect()->route('admin');
            }
            // Utilisateur non-admin : rediriger vers l'accueil pour éviter les 403/boucles
            return redirect('/');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ]);
    }

    public function me()
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403);
        }

        // Statistiques du dashboard
        $totalUsers = \App\Models\User::count();
        $totalProduits = \App\Models\Produit::count();
        $totalCategories = \App\Models\Categorie::count();
        $totalMarques = \App\Models\Marque::count();
        
        // Utilisateurs récents (derniers 5)
        $recentUsers = \App\Models\User::latest()->take(5)->get();
        
        // Produits récents (derniers 5)
        $recentProduits = \App\Models\Produit::latest()->take(5)->get();
        
        // Catégories avec nombre de produits
        $categoriesWithCount = \App\Models\Categorie::withCount('produits')->get();

        return view('admin.view.index', compact(
            'user',
            'totalUsers',
            'totalProduits',
            'totalCategories',
            'totalMarques',
            'recentUsers',
            'recentProduits',
            'categoriesWithCount'
        ));
    }
}
