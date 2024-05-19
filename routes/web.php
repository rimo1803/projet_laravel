<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\DirecteurController;
use App\Http\Controllers\ProfileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Route pour afficher le formulaire de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route pour gérer la soumission du formulaire de connexion
Route::post('/login', [AuthController::class, 'login']);

// Route pour afficher le formulaire de demande de congé
Route::get('/demande-conge', [CongeController::class, 'creation'])->name('demande.conge');
Route::post('/demande-conge', [CongeController::class, 'demanderConge'])->name('demande.conge.submit');
Route::delete('/demande-conge/{id}', [CongeController::class, 'supprimerDemandeConge'])->name('demande.conge.supprimer');
Route::put('/demande-conge/{id}/valider', [CongeController::class, 'validerDemandeConge'])->name('demande.conge.valider');
Route::put('/demande-conge/{id}/refuser', [CongeController::class, 'refuserDemandeConge'])->name('demande.conge.refuser');

// Route pour créer un utilisateur
Route::group(['middleware' => 'web'], function () {
    Route::get('/create-user', [PersonnelController::class, 'create'])->name('personnels.create');
    Route::post('/create-user', [PersonnelController::class, 'store'])->name('personnels.store');
});

// Route pour afficher l'accueil de l'utilisateur normal
Route::get('/accueil', function () {
    return view('layouts.master');
})->name('accueil');

// Route pour afficher l'accueil du directeur
Route::get('/accueildire', function () {
    return view('layouts.master');
})->name('accueildire');

// Route pour afficher les absences d'un utilisateur
Route::get('/absences/{id}', [PersonnelController::class, 'showpersonnelabsence'])->name('showabs');

// Route pour afficher la liste des utilisateurs
Route::get('/liste', [PersonnelController::class, 'index'])->name('showliste');

// Route pour afficher le profil d'un utilisateur
Route::get('/profile/{id}', [PersonnelController::class, 'showProfile'])->name('profile');

// Route pour créer un directeur
Route::get('/create-directeur', [DirecteurController::class, 'create'])->name('directeur.create');
Route::post('/store-directeur', [DirecteurController::class, 'store'])->name('directeur.store');

// routes/web.php



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
});
