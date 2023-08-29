<?php

use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\IncidenciaController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('prueba', function(){
    return Inertia::render('admin/adminhome');
})->name('prueba');

Route::resource('etiqueta', EtiquetaController::class);
Route::resource('incidencia', IncidenciaController::class);