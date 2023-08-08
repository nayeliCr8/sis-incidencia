<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('prueba', function(){
    return "hola mundo";
})->name('prueba');