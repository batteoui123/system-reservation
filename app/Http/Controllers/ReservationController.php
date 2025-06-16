<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Reservation;
use App\Models\Local;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{






  public function dashboard2()
{

    $utilisateurId =auth()->id();
    $etudiantId = Etudiant::where('utilisateur_id', $utilisateurId)->first()->id;



    $reservations = Reservation::with('local')
        ->where('etudiant_id', $etudiantId)
        ->where('statut', '!=', 'termine') // 🔍 exclusion des réservations terminées
        ->orderBy('date', 'desc')
        ->get()
        ->map(function ($reservation) {
            return (object)[
                'id' => $reservation->id,
                'local' => (object)['nom' => $reservation->local->nom],
                'date' => $reservation->date,
                'creneau' => $reservation->heure_debut . ' - ' . $reservation->heure_fin,
                'statut' => $reservation->statut,
                'motif_refus' => $reservation->motif_refus,
            ];
        });

    return view('etudiant.dashboard', compact('reservations'));

}






    public function create_reservation(Request $request, $localId)
    {
        $utilisateurId =auth()->id();
        $etudiantId = Etudiant::where('utilisateur_id', $utilisateurId)->first()->id;


        // Validation standard
        $request->validate([
            'date' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'motif_reservation' => 'required|string|max:255',
        ]);

        $date = $request->date;
        $heureDebut = $request->heure_debut;
        $heureFin = $request->heure_fin;

        // Vérifier la plage horaire autorisée
        if ($heureDebut < '09:00' || $heureFin > '18:00') {
            return back()->withErrors([
                'heure_debut' => 'Les réservations doivent être faites entre 09:00 et 18:00.',
            ])->withInput();
        }

        // ⚠️ Vérifier que la réservation est faite au moins 24h en avance
        $datetimeReservation = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $heureDebut);
        if ($datetimeReservation->lt(now()->addDay())) {
            return back()->withErrors([
                'date' => 'La réservation doit être faite au moins 24h à l\'avance.',
            ])->withInput();
        }

        // Vérifier les conflits avec les réservations ACCEPTÉES
        $conflit = Reservation::where('local_id', $localId)
            ->where('date', $date)
            ->where('statut', 'accepte')
            ->where(function ($query) use ($heureDebut, $heureFin) {
                $query->whereBetween('heure_debut', [$heureDebut, $heureFin])
                    ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                    ->orWhere(function ($q) use ($heureDebut, $heureFin) {
                        $q->where('heure_debut', '<=', $heureDebut)
                            ->where('heure_fin', '>=', $heureFin);
                    });
            })
            ->exists();

        if ($conflit) {
            return back()->withErrors(['local' => 'Ce local est déjà réservé sur ce créneau.'])->withInput();
        }

        // Création de la réservation
        Reservation::create([
            'date' => $date,
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin,
            'statut' => 'en attente',
            'motif_reservation' => $request->motif_reservation,
            'etudiant_id' => $etudiantId,
            'local_id' => $localId,
        ]);

        return redirect()->back()->with('success', 'Réservation envoyée avec succès.');
    }



    public function getLocauxDisponibles(Request $request)
    {
        // Cas initial (sans paramètres)
        if (!$request->filled(['date', 'heure_debut', 'heure_fin'])) {
            return view('etudiant.salles', [
                'locaux' => collect(),
                'sallesParType' => Local::pluck('nom')->unique(),
                'filters' => [
                    'type' => null,
                    'nom' => null,
                    'date' => now()->format('Y-m-d'),
                    'heure_debut' => '08:00',
                    'heure_fin' => '09:00',
                ]
            ]);
        }

        // Cas avec paramètres (soumission du formulaire)
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'type' => 'nullable|string',
            'nom' => 'nullable|string',
        ]);

        $date = $validated['date'];
        $heureDebut = $validated['heure_debut'];
        $heureFin = $validated['heure_fin'];

        $query = Local::query();

        if (!empty($validated['type'])) {
            $query->where('type', $validated['type']);
        }

        if (!empty($validated['nom'])) {
            $query->where('nom', 'like', '%' . $validated['nom'] . '%');
        }

        $query->whereDoesntHave('reservations', function ($q) use ($date, $heureDebut, $heureFin) {
            $q->where('date', $date)
                ->where(function ($qq) use ($heureDebut, $heureFin) {
                    $qq->whereBetween('heure_debut', [$heureDebut, $heureFin])
                        ->orWhereBetween('heure_fin', [$heureDebut, $heureFin])
                        ->orWhere(function ($sub) use ($heureDebut, $heureFin) {
                            $sub->where('heure_debut', '<=', $heureDebut)
                                ->where('heure_fin', '>=', $heureFin);
                        });
                });
        });

        $locauxDisponibles = $query->get();

        $sallesParType = !empty($validated['type'])
            ? Local::where('type', $validated['type'])->pluck('nom')->unique()
            : Local::pluck('nom')->unique();

        return view('etudiant.salles', [
            'locaux' => $locauxDisponibles,
            'date' => $date,
            'heure_debut' => $heureDebut,
            'heure_fin' => $heureFin,
            'filters' => $validated,
            'sallesParType' => $sallesParType,
        ]);
    }





}
