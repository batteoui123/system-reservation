<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Vérifier si l'utilisateur est admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/'); // Rediriger vers la page de connexion si ce n'est pas un admin
        }

        // Récupérer toutes les réservations
        $reservations = Reservation::all(); // Récupère toutes les réservations (ou selon les filtres)

        // Retourner la vue avec les réservations
        return response()->json($reservations);
    }


    public function acceptReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'accepte';
        $reservation->save();

        // Marquer le local comme occupé
        $local = $reservation->local;
        $local->status = 'occupe';
        $local->save();
        return response()->json($local);

//        return redirect()->back()->with('success', 'Réservation acceptée, salle marquée comme occupée.');
    }


}
