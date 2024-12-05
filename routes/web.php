<?php

use Illuminate\Support\Facades\Route;
// use: import file : namespace\namaclass\
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KalenderController;
use App\Models\Reservation;

    //error.permission
    Route::get('/error.permission', function() {
        return view('error-permission');
    })->name('error.permission');

    //login
Route::middleware(['IsGuest'])->group(function() {    
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [UserController::class, 'loginAuth'])->name('login.auth');
});

    //logout
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    //route
Route::middleware(['IsLogin'])->group(function () {

    Route::get('/landing-page', function () {
        return view('landing-page');
    })->name('landing-page');
    
    Route::get('/user', function () {
        return view('user.index');
    });
    
    Route::prefix('/reservations')->name('reservations.')->group(function(){
        Route::get('/', [ReservationController::class, 'index'])->name('index'); // Menampilkan daftar lapangan
        Route::get('/create', [ReservationController::class, 'create'])->name('create'); // Form tambah lapangan
        Route::post('/store', [ReservationController::class, 'store'])->name('store'); // Menyimpan lapangan baru
        Route::get('/{id}', [ReservationController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [ReservationController::class, 'update'])->name('update');
        Route::delete('/{reservation}', [ReservationController::class, 'destroy'])->name('delete');
    });

    // Admin
Route::middleware(['IsAdmin'])->group(function () {
    Route::get('/admin.dashboard', function(){
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('/user')->name('user.')->group(function(){
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/', [UserController::class, 'index'])->name('home');
        Route::get('/{id}', [UserController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('delete');
    });
});

    // Route::get('/calendar', [KalenderController::class, 'index'])->name('calendar');
    // Route::get('/landing-page', [KalenderController::class, 'show'])->name('landing.page');
});