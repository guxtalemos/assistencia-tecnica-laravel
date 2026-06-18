<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentController;



Route::get('/', [EquipamentController::class, 'index']);
Route::get('/equipaments/create', [EquipamentController::class, 'create'])->middleware('auth');
Route::get('/equipaments/{id}', [EquipamentController::class, 'show']);
Route::post('/equipaments', [EquipamentController::class, 'store']);

Route::get('dashboard', [EquipamentController::class, 'dashboard'])->middleware('auth');

Route::delete('/equipaments/{id}', [EquipamentController::class, 'destroy'])->middleware('auth');
Route::get('/equipaments/edit/{id}', [EquipamentController::class, 'edit'])->middleware('auth');
Route::put('/equipaments/update/{id}', [EquipamentController::class, 'update'])->middleware('auth');


