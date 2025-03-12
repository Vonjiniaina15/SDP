<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipementController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test',[EquipementController::class, 'index'] );
