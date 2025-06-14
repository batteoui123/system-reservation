<?php


use App\Http\Controllers\AuthController;
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

Route::get('/calendar', function () {
    return view('calendar');
})->name('calendar');

Route::get('/login-admin', function () {
    return view('auth.login-admin');
})->name('login.admin');

Route::get('/login-etudiant', function () {
    return view('auth.login-etudiant');
})->name('login.etudiant');

Route::post('/logins', [AuthController::class, 'loginEtudiant'])->name('login.etu');
Route::post('/logina', [AuthController::class, 'loginAdmin'])->name('login.ad');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

