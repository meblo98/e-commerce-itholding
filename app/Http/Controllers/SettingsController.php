<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => ['required', 'email', 'in:'.$user->email],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'email.in' => 'Cette adresse email ne correspond pas à votre compte.',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Mot de passe mis à jour avec succès.');
    }
}
