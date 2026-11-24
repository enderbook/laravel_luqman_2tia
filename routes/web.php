<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::resource('pelanggan', PelangganController::class);

Route::get('/', function () {
    return view('welcome');
});
Route::resource('user', UserController::class);

Route::get('/home', [HomeController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/detail', [PelangganController::class, 'detail'])->name('detail');
Route::post('question/store', [QuestionController::class, 'store'])->name('question.store');
Route::get('question/response', [QuestionController::class, 'response'])->name('question.response');


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('auth.logout');


Route::get('/pelanggan/{id}/cv-online', [
    PelangganController::class,
    'cvOnline'
])->name('pelanggan.cv-online');
