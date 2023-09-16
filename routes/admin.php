<?php

use App\Http\Controllers\EquipoController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\OficinaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);
Route::resource('permissions', PermissionController::class);

Route::get('prueba', function(){
    return Inertia::render('admin/adminhome');
})->name('prueba')->middleware(['auth','role:superadmin']);

Route::middleware(['auth'])->group(function () {
    Route::resource('etiqueta', EtiquetaController::class);
    Route::resource('incidencia',IncidenciaController::class);
    Route::resource('sedes',SedeController::class);
    Route::resource('oficinas',OficinaController::class);
    Route::resource('equipos',EquipoController::class);
});
    
