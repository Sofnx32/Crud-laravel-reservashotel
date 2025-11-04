<?php

use Illuminate\Support\Facades\Route;

Route::resource('reservas', App\Http\Controllers\ReservasController::class);
Route::resource('clientes', App\Http\Controllers\ClienteController::class);

Route::get('/', function () {
    return redirect()->route('reservas.index');
});
