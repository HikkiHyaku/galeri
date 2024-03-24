<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CRUDController;

Route::get('/', function () {
    return view('welcome');
});

//routes login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'create']);

//Middleware
Route::middleware('auth')->group(function () {
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('useRole');
});

//CRUD
Route::get('/users', [CRUDController::class, 'index'])->name('admin.users');
Route::get('/users/create', [CRUDController::class, 'create'])->name('users.create');
Route::post('/users', [CRUDController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [CRUDController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [CRUDController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [CRUDController::class, 'destroy'])->name('users.destroy');

Route::resource('users', CRUDController::class);
