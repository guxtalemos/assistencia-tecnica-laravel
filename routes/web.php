<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipamentController;
use App\Http\Controllers\ManutencaoController;

Route::redirect('/dashboard', '/equipaments/dashboard');

Route::get('/', [EquipamentController::class, 'index']);

Route::get('/equipaments/create', [EquipamentController::class, 'create'])->middleware('auth');
Route::get('/equipaments/dashboard', [EquipamentController::class, 'dashboard'])->middleware('auth');

Route::get('/equipaments/{id}', [EquipamentController::class, 'show']);
Route::post('/equipaments', [EquipamentController::class, 'store']);
Route::delete('/equipaments/{id}', [EquipamentController::class, 'destroy'])->middleware('auth');
Route::get('/equipaments/edit/{id}', [EquipamentController::class, 'edit'])->middleware('auth');
Route::put('/equipaments/update/{id}', [EquipamentController::class, 'update'])->middleware('auth');

Route::get('/manutencoes', [ManutencaoController::class, 'index']);
Route::get('/manutencoes/create', [ManutencaoController::class, 'create'])->middleware('auth');

Route::get('/manutencoes/{id}', [ManutencaoController::class, 'show']);
Route::post('/manutencoes', [ManutencaoController::class, 'store']);
Route::delete('/manutencoes/{id}', [ManutencaoController::class, 'destroy'])->middleware('auth');
Route::get('/manutencoes/edit/{id}', [ManutencaoController::class, 'edit'])->middleware('auth');
Route::put('/manutencoes/update/{id}', [ManutencaoController::class, 'update'])->middleware('auth');