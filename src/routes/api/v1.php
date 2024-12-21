<?php

use App\Http\Controllers\DepartmentController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/departments', [DepartmentController::class, 'store'])->name('departments.store');
