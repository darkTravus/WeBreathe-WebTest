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

// Home route 
Route::get('/', [HomeController::class, 'index'])->name('home');

// Show graphs for a specific module
Route::get('/modules/{id}', [HistoryModuleController::class, 'show'])->name('modules.graphs');

// Get the status of a module
Route::get('/get-module-status/{moduleId}', [ModuleController::class, 'getModuleStatus'])->name('modules.status');

// Get status for all modules
Route::get('/get-modules-issues', [ModuleController::class, 'getModuleIssues'])->name('modules.issues');

// Get the histrories of a module with filter based on DateTime
Route::get('/get-module-history/{moduleId}', [HistoryModuleController::class, 'getHistoryWithFilters'])->name('modules.history.filters');

// Show the create form for a module
Route::get('/module/create', [ModuleController::class, 'create'])->name('modules.create');

// To submit the data to create a new module
Route::post('/module', [ModuleController::class, 'store'])->name('modules.store');
