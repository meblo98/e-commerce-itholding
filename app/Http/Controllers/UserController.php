<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Afficher le formulaire d'ajout d'utilisateur
     */
    public function create()
    {
        return view('admin.view.users-add');
    }

    /**
     * Stocker un nouvel utilisateur
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ], [
            'name.required' => 'Le prénom est requis',
            'lastname.required' => 'Le nom est requis',
            'email.required' => 'L\'email est requis',
            'email.unique' => 'Cet email existe déjà',
            'phone.required' => 'Le téléphone est requis',
            'phone.numeric' => 'Le téléphone doit être numérique',
            'phone.unique' => 'Ce numéro de téléphone existe déjà',
            'password.required' => 'Le mot de passe est requis',
            'password.min' => 'Le mot de passe doit avoir au moins 8 caractères',
            'password.confirmed' => 'Les mots de passe ne correspondent pas',
            'role.required' => 'Le rôle est requis',
        ]);

        // Créer l'utilisateur
        try {
            $user = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'password' => bcrypt($validated['password']),
                'role' => $validated['role'],
            ]);

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur créé avec succès');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la création : ' . $e->getMessage());
        }
    }

    /**
     * Lister tous les utilisateurs
     */
    public function index()
    {
        $users = User::all();
        return view('admin.view.users-list', compact('users'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(User $user)
    {
        return view('admin.view.users-edit', compact('user'));
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric|unique:users,phone,' . $user->id,
            'role' => 'required|string|in:admin,user',
        ]);

        try {
            $user->update($validated);
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur mis à jour avec succès');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    /**
     * Supprimer un utilisateur
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()
                ->route('admin.users.index')
                ->with('success', 'Utilisateur supprimé avec succès');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }
}
