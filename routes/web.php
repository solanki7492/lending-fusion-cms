<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TermsheetController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('home');
    Route::get('/termsheet', [TermsheetController::class ,'index'])->name('termsheet');
    Route::get('/termsheet/create', [TermsheetController::class ,'create'])->name('termsheet.create');
    Route::post('/termsheet/generate-pdf', [TermsheetController::class ,'getGeneratePDF'])->name('termsheet.generate.pdf');
    Route::post('/termsheet/preview', [TermsheetController::class, 'getGeneratePDF'])->name('termsheet.preview.pdf');
    Route::post('/termsheet/store', [TermsheetController::class, 'store'])->name('termsheet.store');

});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class,'login'])->name('login.store');
});

Route::post('logout', [LoginController::class,'logout'])->middleware('auth')->name('logout');


