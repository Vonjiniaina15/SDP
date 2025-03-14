<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [EquipementController::class, 'index']);

// ligne pour la route de création
Route::get('/equipements/create', [EquipementController::class, 'create'])->name('equipements.create');

Route::resource('equipements', EquipementController::class);