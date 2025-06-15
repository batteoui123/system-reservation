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
//}

  //accepter la reservation
    public function acceptReservation($id)
    {
        // Vérifier si l'utilisateur est admin
        if (Auth::user()->role !== 'admin') {
            return redirect('/login'); // Rediriger si ce n'est pas un admin
        }

        // Trouver la réservation par son ID
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->back()->with('error', 'Réservation non trouvée.');
        }

        $reservation->status = 'accepté'; // Exemple de statut
        $reservation->save(); // Enregistrer les changements

        // Rediriger vers la liste des réservations avec un message de succès
        return redirect()->route('admin.reservations')->with('success', 'Réservation acceptée avec succès.');
    }

}
