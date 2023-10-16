<?php

use App\Http\Controllers\TestPhotoController;
use App\Http\Controllers\PhotoController;
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


Route::middleware('auth')->group(function () {

    Route::get('/home', [PhotoController::class, 'index'])->name('home');

    Route::post('/home-store', [PhotoController::class, 'store'])->name('store');

    Route::post('/home-edit', [PhotoController::class, 'edit'])->name('edit');

    Route::post('/home-destroy', [PhotoController::class, 'destroy'])->name('destroy');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});



Route::get('/login', [UserController::class, 'index'])->name('login');

Route::post('/login', [UserController::class, 'login'])->name('postLogin');

Route::post('/create-account', [UserController::class, 'store'])->name('create-account');

Route::get('/create-account', [UserController::class, 'create'])->name('show-create-account');

Route::get('/test', function () {
    return view('test');
})->name('test');

Route::get('/facebook', function () {
    return view('facebook');
})->name('facebook');

Route::post('/photo', [TestPhotoController::class, 'store'])->name('postPhoto');
Route::get('/photo', [TestPhotoController::class, 'create'])->name('photo');



