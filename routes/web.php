<?php

use App\Http\Controllers\Adm\CouponController;
use App\Http\Controllers\Login\LoginController;
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
Route::get('/', [LoginController::class, 'index'])->name('login.view');
Route::post('/login-submit',[LoginController::class, 'login'])->name('login.submit');
Route::get('/logout',[LoginController::class, 'logout'])->name('login.logout');

Route::group(['middleware' => 'user.session'], function () {
    Route::get('/adm',[CouponController::class, 'index'])->name('adm');
});


Route::get('/adm',[CouponController::class, 'index'])->name('adm');
