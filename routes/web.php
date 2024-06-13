<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\MedecinController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/ajouterMedecin',[MedecinController::class,'addMedecin']);
Route::post('/storeMedecin',[MedecinController::class,'store']);
Route::get('/listesMedecin',[MedecinController::class,'listesMedecin']);
Route::get('/editMedecin/{id}',[MedecinController::class,'detailsMedecin'])->name('edit.medecin');
Route::get('/specialite',[MedecinController::class,'listeSpecialite'])->name('liste.Specialite');
Route::post('/addSpecialte',[MedecinController::class,'addSpecialite'])->name('add.Specialite');

Route::post('/updateMedecin',[MedecinController::class,'update']);


Route::get('/callendarMedecin', [AppointmentController::class, 'index']);
Route::get('/api/appointments', [AppointmentController::class, 'fetchAppointments']);
Route::post('/api/appointments', [AppointmentController::class, 'store']);
