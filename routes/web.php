<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//admin
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    //sales
    Route::get('salles', [AdminController::class, 'getLocaux'])->name('salles.index');
    Route::post('salles', [AdminController::class, 'store'])->name('salles.store');
    Route::put('salles/{id}', [AdminController::class, 'update'])->name('salles.update');
    Route::delete('salles/{id}', [AdminController::class, 'destroy'])->name('salles.destroy');

  //reservations
    Route::get('reservations', [AdminController::class, 'getReservations'])->name('reservations.index');
    Route::post('reservations/{id}/valider', [AdminController::class, 'validerReservation'])->name('reservations.valider');
    Route::post('reservations/{id}/refuser', [AdminController::class, 'refuserReservation'])->name('reservations.refuser');


    //dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
});

Route::prefix('etudiant')->name('etudiant.')->middleware('auth')->group(function () {
    Route::get('dashboard', [ReservationController::class, 'dashboard2'])->name('dashboard');
    Route::get('salles', [ReservationController::class, 'getLocauxDisponibles'])->name('salles');
    Route::post('reservations/{local}', [ReservationController::class, 'create_reservation'])->name('reservation.create');
    Route::delete('/reservations/annuler/{id}', function ($id) {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return redirect()->back()->withErrors('Réservation introuvable.');
        }

        $reservation->delete();

        return redirect()->back()->with('success', 'Réservation annulée avec succès.');
    })->name('annuler');

});


//etudiant




























