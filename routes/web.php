<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AppointmentControllers;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
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


Route::get('/Authentification', [AdminController::class, 'login_users'])->name('login.users');
Route::post('/Authentification/users', [AdminController::class, 'doLogin'])->name('doLogin.users');

Route::get('/patient/home', [PatientController::class, 'home'])->name('home.client');
Route::post('/patient/create-account', [PatientController::class, 'addAccountPatient'])->name('add.account.patient');
Route::post('/patient/login-patient', [PatientController::class, 'loginPatient'])->name('login.patient');

Route::middleware(['auth.patient'])->group(function(){
    Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('dashboard.client');
    Route::post('/patient/dashboard/update-account', [PatientController::class, 'updateccountPatient'])->name('updateccount.Patient');
    Route::post('/patient/dashboard/demande-patient', [PatientController::class, 'addDemande'])->name('addDemande.patient');
    Route::post('/patient/dashboard/update-motif', [PatientController::class, 'updateMotif'])->name('updateMotif.patient');

    Route::get('/patient/dashboard/update-profile', [PatientController::class, 'edit'])->name('edit.patient');
    Route::get('/logout-patient', [PatientController::class, 'logoutPatient'])->name('logout.patient');



});
Route::middleware([ 'auth.users'])->group(function () {

    Route::get('/ajouterMedecin',[MedecinController::class,'addMedecin']);
    Route::post('/storeMedecin',[MedecinController::class,'store']);
    Route::get('/listesMedecin',[MedecinController::class,'listesMedecin']);
    Route::get('/editMedecin/{id}',[MedecinController::class,'detailsMedecin'])->name('edit.medecin');
    Route::get('/specialite',[MedecinController::class,'listeSpecialite'])->name('liste.Specialite');
    Route::post('/addSpecialte',[MedecinController::class,'addSpecialite'])->name('add.Specialite');
    Route::post('/rechercheMedecin',[MedecinController::class,'search'])->name('search.medecin');
    Route::post('/updateMedecin',[MedecinController::class,'update']);
    Route::post('/searcheSpecialite',[MedecinController::class,'searchSpecialite'])->name('search.Specialite');
    Route::post('/addSpecialite',[MedecinController::class,'addSpecialiteToMedecin'])->name('addSpecialite.To.Medecin');
    Route::get('/', [AdminController::class, 'home'])->name('home');
    Route::get('/callendarMedecin', [AppointmentController::class, 'index']);
    Route::get('/listeEmploie', [AppointmentControllers::class, 'index']);
    Route::post('/addEmploie', [AppointmentControllers::class, 'store'])->name('addEmploie');
    Route::post('/deleteEmploie', [AppointmentControllers::class, 'destroy']);
    Route::post('/updateEmploie', [AppointmentControllers::class, 'update']);

    Route::get('/patient/dashboard/update-profile', [AdminController::class, 'edit'])->name('edit.patient');


    Route::get('/logoutUsers',[AdminController::class,'logoutUsers'])->name('logout.users');
    Route::get('/listesUsers', [AdminController::class, 'users'])->name('listes.users');

    Route::post('/users/addUsers', [AdminController::class, 'addUser'])->name('add.users');
    Route::post('/users/update-profile', [AdminController::class, 'updateUser'])->name('update.user');
    Route::post('/users/update-password', [AdminController::class, 'updatepasswordUser'])->name('update.password.users');

    Route::get('/users/recherche-users', [AdminController::class, 'search'])->name('search.users');

});
