<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/departments', [DepartmentController::class, 'index'])->name('v1.departments.index');
Route::get('/departments/{departmentUuid}', [DepartmentController::class, 'show'])->name('v1.departments.show');
Route::post('/departments', [DepartmentController::class, 'store'])->name('v1.departments.store');
Route::patch('/departments/{departmentUuid}', [DepartmentController::class, 'update'])->name('v1.departments.update');


Route::get('/employees', [EmployeeController::class, 'index'])->name('v1.employees.index');

Route::group(['prefix' => '/employees'], function () {
    Route::get('/{employeeUuid}', [EmployeeController::class, 'show'])->name('v1.employees.show');
    Route::post('/', [EmployeeController::class, 'store'])->name('v1.employees.store');
});
