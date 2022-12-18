<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserServiceController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, "index"])->name('home');
Route::get('/register', [UserController::class, "index"])->name('register');
Route::post('/register-post', [UserController::class, "register"])->name('actionRegister');

/**
 * route login
 */
Route::get('/', [HomeController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth');

/**
 * routes pages admin
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::prefix('/car')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('car');
        Route::post('/register', [CarController::class, 'register'])->name('carRegister');
        Route::get('/delete/{id}', [CarController::class, 'delete'])->name('carDelete');
        Route::get('/edit/{id}', [CarController::class, 'edit'])->name('carEdit');
        Route::match(['get', 'post'], '/update/{id}', [CarController::class, 'update'])->name('carUpdate');
        Route::get('/api/model', [CarController::class, 'getAjaxModelAll'])->name('apiModel');
    });

    Route::prefix('/user-service')->group(function () {
        Route::get('/', [UserServiceController::class, 'index'])->name('userService');
        Route::post('/register', [UserServiceController::class, 'register'])->name('userServiceRegister');
        Route::get('/list', [UserServiceController::class, 'list'])->name('userServiceList');
        Route::get('/delete/{id}', [UserServiceController::class, 'delete'])->name('userServiceDelete');
        Route::get('/edit/{id}', [UserServiceController::class, 'edit'])->name('userServiceEdit');
        Route::match(['get', 'post'], '/update/{id}', [UserServiceController::class, 'update'])->name('userServiceUpdate');
    });
});
