<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyContoller;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('companies', CompanyContoller::class);

// Employees Routes
Route::resource('employees', EmployeeController::class);

Route::get('/phpinfo', function() {
    return phpinfo();
});
