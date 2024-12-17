<?php

use App\Http\Controllers\M4MController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/m4m/data', [M4MController::class, 'getL1N']);
