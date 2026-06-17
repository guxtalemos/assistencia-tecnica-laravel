<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentController;



Route::get('/', [EquipamentController::class, 'index']);
Route::get('/equipaments/create', [EquipamentController::class, 'create']);
Route::post('/equipaments', [EquipamentController::class, 'store']);
Route::get('/equipaments/{id}', [EquipamentController::class, 'show']);