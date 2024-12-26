<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DepartmentEmployeeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaydayController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/departments'], function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('v1.departments.index');
    Route::get('/{departmentUuid}', [DepartmentController::class, 'show'])->name('v1.departments.show');
    Route::get('/{departmentUuid}/employees', [DepartmentEmployeeController::class, 'index'])->name('v1.department-employees.index');
    Route::post('/', [DepartmentController::class, 'store'])->name('v1.departments.store');
    Route::patch('/{departmentUuid}', [DepartmentController::class, 'update'])->name('v1.departments.update');
});



Route::group(['prefix' => '/employees'], function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('v1.employees.index');
    Route::get('/{employeeUuid}', [EmployeeController::class, 'show'])->name('v1.employees.show');
    Route::post('/', [EmployeeController::class, 'store'])->name('v1.employees.store');
});


Route::post('/payday', [PaydayController::class, 'store'])->name('payday.store');
