<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryModuleController;

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

// Route d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route pour afficher les graphes par rapport à un module
Route::get('/modules/{id}', [HistoryModuleController::class, 'show'])->name('modules.graphs');

// Route pour obtenir le statut d'un module
Route::get('/get-module-status/{moduleId}', [ModuleController::class, 'getModuleStatus'])->name('modules.status');

// Route pour obtenir le statut des modules
Route::get('/get-modules-issues', [ModuleController::class, 'getModuleIssues'])->name('modules.issues');

// Route pour récupérer l'historique d'un module avec filtres de date et d'heure
Route::get('/get-module-history/{moduleId}', [HistoryModuleController::class, 'getHistoryWithFilters'])->name('modules.history.filters');

// Route pour afficher le formulaire d'inscription
Route::get('/module/create', [ModuleController::class, 'create'])->name('modules.create');

// Route pour soumettre les données du formulaire
Route::post('/module', [ModuleController::class, 'store'])->name('modules.store');
