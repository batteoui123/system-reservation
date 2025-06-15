<?php

namespace App\Http\Controllers;

use App\Models\Local;
use App\Models\Reservation;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{




    //gestion des reservations
    public function getReservations(Request $request)
    {
        $query = Reservation::with(['etudiant.utilisateur', 'local']);

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $reservations = $query->latest()->get();

        return view('admin.reservations', compact('reservations'));
    }

    public function validerReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'accepte';
        $reservation->save();

        $local=$reservation->local;
        $local->status = 'occupe';
        $local->save();

        return redirect()->back()->with('success', 'Réservation acceptée.');
    }

    public function refuserReservation(Request $request, $id)
    {
//        $request->validate([
//            'motif_refus' => 'required|string|max:255',
//        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->statut = 'refuse';
        $reservation->motif_refus = $request->motif_refus;
        $reservation->save();

        return redirect()->back()->with('success', 'Réservation refusée avec motif.');
    }









    //gestion des salles
    public function getLocaux(Request $request)
    {
        $type = $request->query('type');

        $query = Local::query();

        if ($type) {
            $query->where('type', $type);
        }

        $locaux = $query->get();

        return view('admin.salles', compact('locaux'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'type' => 'required|in:salle,amphi,conference',
        ]);

        Local::create([
            'nom' => $request->nom,
            'capacite' => $request->capacite,
            'type' => $request->type,
            'status' => 'libre', // statut initial
        ]);

        return redirect()->route('admin.salles.index')->with('success', 'Salle ajoutée avec succès.');
    }

    public function destroy($id)
    {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->route('admin.salles.index')->with('success', 'Salle supprimée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer|min:1',
            'type' => 'required|string'
        ]);

        $local = Local::findOrFail($id);
        $local->update([
            'nom' => $request->nom,
            'capacite' => $request->capacite,
            'type' => $request->type
        ]);

        return redirect()->route('admin.salles.index')->with('success', 'Local mis à jour avec succès.');
    }



    //dashboard

    public function dashboard()
    {
        $totalLocaux = Local::count();
        $locauxLibres = Local::where('status', 'libre')->count();
        $locauxOccupes = $totalLocaux - $locauxLibres;

        $reservationsRecentes = Reservation::with(['etudiant.utilisateur', 'local'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalLocaux',
            'locauxLibres',
            'locauxOccupes',
            'reservationsRecentes'
        ));
    }




}
