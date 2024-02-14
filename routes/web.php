<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModuleController;

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
    return view('welcome');
});

// Route pour afficher le formulaire d'inscription
Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');

// Route pour soumettre les données du formulaire
Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
