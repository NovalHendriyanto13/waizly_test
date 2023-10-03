<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Employees\EmployeeController;

Route::post('/', [EmployeeController::class, 'index']);
Route::post('/create', [EmployeeController::class, 'create']);
Route::get('/detail/{id}', [EmployeeController::class, 'detail']);
Route::put('/update/{id}', [EmployeeController::class, 'update']);
Route::get('/job-title/count', [EmployeeController::class, 'getCountJob']);
Route::get('/summary', [EmployeeController::class, 'getSummary']);
Route::get('/average', [EmployeeController::class, 'getAvgSalary']);
Route::get('/average-department', [EmployeeController::class, 'getAvgSalaryDepartment']);