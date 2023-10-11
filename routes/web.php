<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/test', function () {
//    return view('welcome');
//});

Route::middleware('auth')->group(function () {

    Route::get('/home', [TaskController::class, 'index'])->name('home');

    Route::post('/home-store', [TaskController::class, 'store'])->name('store');

    Route::post('/home-edit', [TaskController::class, 'edit'])->name('edit');

    Route::post('/home-destroy', [TaskController::class, 'destroy'])->name('destroy');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});



Route::get('/login', [UserController::class, 'index'])->name('login');

Route::post('/login', [UserController::class, 'login'])->name('postLogin');

Route::post('/create-account', [UserController::class, 'create'])->name('create-account');

Route::get('/create-account', [UserController::class, 'showCreateAccount'])->name('show-create-account');

Route::get('/test', function () {
    return view('test');
})->name('test');





