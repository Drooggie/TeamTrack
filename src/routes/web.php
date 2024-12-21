<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('departments', App\Http\Controllers\DepartmentController::class);
