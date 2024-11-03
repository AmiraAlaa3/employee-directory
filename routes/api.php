<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('ip.whitelist')->group(function () {
Route::get('/departments', [DepartmentController::class, 'index']);
Route::get('/departments/{id}/employees', [DepartmentController::class, 'employees']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);


Route::get('/departments/employees/count', [DepartmentController::class, 'employeeCount']);
Route::get('/departments/average_salary', [DepartmentController::class, 'averageSalary']);
Route::get('/employees/highest_salary', [EmployeeController::class, 'getHighestSalary']);
});
