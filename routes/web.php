<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
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



Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
    Route::get('/auth/register', [AuthController::class, 'registerView'])->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/auth/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


    Route::get('/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');
});

Route::group(['middleware' => ['is_verify_email']], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout' , [AdminController::class, 'logout'])->name('logout');
});
