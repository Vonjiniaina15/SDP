<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SousDetailPrixController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\MateriauxController;

Route::apiResource('sousdetailsprix', SousDetailPrixController::class);
Route::apiResource('transports', TransportController::class);
Route::apiResource('materiaux', MateriauxController::class);