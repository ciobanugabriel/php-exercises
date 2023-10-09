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

Route::get('/login', [UserController::class, 'index'])->name('login');

Route::post('/login', [UserController::class, 'login'])->name('postLogin');

Route::get('/home', [TaskController::class, 'index'])->name('home');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::post('/create-account', [UserController::class, 'create'])->name('create_account');

Route::get('/create-account', [UserController::class, 'showCreateAccount'])->name('show_create_account');

Route::post('/home-store', [TaskController::class, 'store'])->name('store');

Route::post('/home-edit', [TaskController::class, 'edit'])->name('edit');

Route::post('/home-destroy', [TaskController::class, 'destroy'])->name('destroy');




Route::post('/test', function () {
    return '<h1>Ce faci Eleno</h1>';
})->name('test');
