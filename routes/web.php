<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::resource('visitors', VisitorController::class);
// routes/web.php
Route::put('/updatevisitor/updateOuttime', [VisitorController::class, 'updateOuttime'])->name('visitors.updateOuttime');
Route::get('/visitors-data', [VisitorController::class, 'getVisitorsData'])->name('visitors.data');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.assignRole');


Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
