<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginEtudiant(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'etudiant')
            ->first();

        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            return redirect('/calendar');
        }

        return back()->withErrors(['email' => 'Échec de connexion étudiant.']);
    }

    // 🧑‍💼 Login admin
    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->where('role', 'admin')
            ->first();

        if ($user && Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
            Auth::login($user);
            return redirect('/calendar');
        }


        return back()->withErrors(['email' => 'Échec de connexion admin.']);
    }

    // 🔓 Déconnexion
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
