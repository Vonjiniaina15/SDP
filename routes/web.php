<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\MainDoeuvreController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [EquipementController::class, 'index']);
// ligne pour la route de création
Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');
Route::resource('equipements', EquipementController::class);

Route::get('/main-doeuvres', [MainDoeuvreController::class, 'index'])->name('main-doeuvres.index');
Route::post('/main-doeuvres', [MainDoeuvreController::class, 'store'])->name('main-doeuvres.store');
Route::put('/main-doeuvres/{id}', [MainDoeuvreController::class, 'update'])->name('main-doeuvres.update');
Route::delete('/main-doeuvres/{id}', [MainDoeuvreController::class, 'destroy'])->name('main-doeuvres.destroy');