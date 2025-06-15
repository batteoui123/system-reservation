<?php


use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\Reservation;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/login-admin', function () {
    return view('auth.login-admin');
})->name('login.admin');

Route::get('/login-etudiant', function () {
    return view('auth.login-etudiant');
})->name('login.etudiant');

Route::post('/logins', [AuthController::class, 'loginEtudiant'])->name('login.etu');
Route::post('/logina', [AuthController::class, 'loginAdmin'])->name('login.ad');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ------ Espace Étudiant ------
// Route::view('/etudiant/locaux', 'etudiant.locaux')->name('etudiant.locaux');


Route::get('/etudiant/locaux', function () {
    $locaux = collect([
        (object)[
            'id' => 1,
            'nom' => 'Salle A1',
            'type' => 'Salle',
            'capacite' => 30,
            'status' => 'libre',
        ],
        (object)[
            'id' => 2,
            'nom' => 'Amphi B',
            'type' => 'Amphithéâtre',
            'capacite' => 120,
            'status' => 'occupé',
        ],
        (object)[
            'id' => 3,
            'nom' => 'Salle C2',
            'type' => 'Salle',
            'capacite' => 20,
            'status' => 'libre',
        ],
    ]);

    return view('etudiant.locaux', compact('locaux'));
})->name('etudiant.locaux');

// Route::view('/etudiant/reserver/1', 'etudiant.reserver')->name('etudiant.reserver'); // remplace "1" par un ID fictif
Route::get('/etudiant/reserver/{id}', function ($id) {
    // Simulation de données de test
    $local = (object)[
        'id' => $id,
        'nom' => 'Salle A' . $id,
        'type' => 'Salle',
        'capacite' => 30,
        'status' => 'libre',
    ];

    return view('etudiant.reserver', compact('local'));
})->name('etudiant.reserver');



Route::get('/etudiant/mes-reservations', function () {
    return view('etudiant.mes_reservations', [
        'reservations' => [
            (object)[
                'id' => 1,
                'local' => (object)['nom' => 'Salle A'],
                'date' => '2025-06-15',
                'creneau' => '08:00 - 10:00',
                'statut' => 'accepté',
                'motif_refus' => null,
            ],
            (object)[
                'id' => 2,
                'local' => (object)['nom' => 'Salle B'],
                'date' => '2025-06-16',
                'creneau' => '10:00 - 12:00',
                'statut' => 'en attente',
                'motif_refus' => null,
            ],
        ],
    ]);
})->name('etudiant.mes_reservations');



Route::get('/etudiant/dashboard', function() {
    $someId = 123; // or fetch dynamically
    $reservations = Reservation::orderBy('date', 'desc')->get();

    // Merge all variables in one array and pass to view
    return view('etudiant.dashboard', [
        'someId' => $someId,
        'reservations' => $reservations,
    ]);
})->name('etudiant.dashboard');






Route::post('/etudiant/reservation', function (Request $request) {
    // Juste pour simuler la réception des données
    return back()->with('success', 'Demande envoyée avec succès !');
})->name('etudiant.storeReservation');


Route::delete('/etudiant/annuler/{id}', function ($id) {
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return redirect()->back()->withErrors('Réservation introuvable.');
    }

    $reservation->delete();

    return redirect()->back()->with('success', 'Réservation annulée avec succès.');
})->name('etudiant.annuler');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::view('/salles', 'admin.salles')->name('salles');
    Route::get('/reservations', function () {
    $reservations = collect([
        (object)[
            'etudiant' => (object)['utilisateur' => (object)['nom' => 'Soukayna']],
            'local' => (object)['nom' => 'Salle B1'],
            'date' => '2025-06-15',
            'creneau' => '08:00 - 10:00'
        ],
        (object)[
            'etudiant' => (object)['utilisateur' => (object)['nom' => 'Karim']],
            'local' => (object)['nom' => 'Salle A2'],
            'date' => '2025-06-16',
            'creneau' => '10:00 - 12:00'
        ],
    ]);
    
    return view('admin.reservations', compact('reservations'));
})->name('reservations');

    Route::view('/utilisateurs', 'admin.utilisateurs')->name('utilisateurs');
});


Route::get('/admin/dashboard', function() {

    return view('admin.dashboard');
})->name('admin.dashboard');