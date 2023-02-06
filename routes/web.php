<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\ActivationCodeController;
use App\Http\Controllers\Admin\VideoContentController;

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
    // home
    Route::get('/', function () {
        return view('auth.login');
    });

    // register view and authentication
    Route::get('/auth/register', [AuthController::class, 'registerView'])->name('register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    //login view and authentication
    Route::get('/auth/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // verify user account from mail
    Route::get('/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');


    // forget password view and authentication
    Route::get('/forget-password', [ForgotPasswordController::class, 'showForgottenPasswordForm'])->name('forget.password.get');

    Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgottenPasswordForm'])->name('forget.password.post');

    //recover password view and authentication
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::group(['middleware' => ['check_session', 'is_verify_email', 'auth']], function(){
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout' , [AdminController::class, 'logout'])->name('logout');

    //categories routes
    Route::controller(CategoriesController::class)->group(function(){
        Route::get('/category', 'index')->name('categories');
        Route::post('/category', 'store')->name('categories.store');
        Route::get('/category/{id}', 'edit')->name('categories.edit');
        Route::post('/category/{id}', 'update')->name('categories.update');
        Route::delete('/category/{id}', 'destroy')->name('categories.delete');
    });

    //activation codes routes
    Route::controller(ActivationCodeController::class)->group(function(){
        Route::get('/activation-code', 'index')->name('activation');
        Route::get('/activation-code/create','create')->name('activation.create');
        Route::post('/activation-code/create','store')->name('activation.store');
        Route::delete('/activation-code/delete/{id}','destroy')->name('activation.destroy');
    });

    Route::controller(VideoContentController::class)->group(function(){
        Route::get('/video-content', 'index')->name('video');
        Route::get('/video-content/create', 'create')->name('video.create');
        Route::post('/video-content', 'store')->name('video.store');
    });
});
