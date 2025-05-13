<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TermsheetController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class ,'dashboard'])->name('dashboard');
    Route::get('/termsheet', [TermsheetController::class ,'index'])->name('termsheet');
    Route::get('/termsheet/create', [TermsheetController::class ,'create'])->name('termsheet.create');
    Route::post('/termsheet/generate-pdf', [TermsheetController::class ,'getGeneratePDF'])->name('termsheet.generate.pdf');
    Route::post('/termsheet/preview', [TermsheetController::class, 'getGeneratePDF'])->name('termsheet.preview.pdf');
    Route::post('/termsheet/store', [TermsheetController::class, 'store'])->name('termsheet.store');
    Route::get('/lead/search', [TermsheetController::class, 'search'])->name('lead.search');
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::Delete('/{user}/delete', [UserController::class, 'delete'])->name('users.destroy');
        
    });
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/{user}/update', [UserController::class, 'updateProfile'])->name('profile.update');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login'])->name('login.store');
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [LoginController::class,'register'])->name('register.store');
});

Route::post('logout', [LoginController::class,'logout'])->middleware('auth')->name('logout');


