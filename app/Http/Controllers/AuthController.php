<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController
{
    //login etudiant
//    public function login()
//    {
//        return response()->json(['message' => 'Connexion réussie. Bienvenue, ']);
////        $request->validate([
////            'email' => 'required|email',
////            'mot_de_passe' => 'required',
////        ]);
////
////        $utilisateur = Utilisateur::where('email', $request->email)->first();
////
////        if ($utilisateur && $utilisateur->role === 'etudiant' && Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
////            Auth::login($utilisateur);
////            return redirect('/calendar');
//////            return response()->json(['message' => 'Connexion réussie. Bienvenue, ' . $utilisateur->nom . '!']);
////      }
////
////        return back()->withErrors(['email' => 'Identifiants invalides ou accès non autorisé.']);
//    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Connexion API réussie ✅'
        ]);
    }

}



