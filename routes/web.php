<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\karyawanController; 
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('home',karyawanController::class);