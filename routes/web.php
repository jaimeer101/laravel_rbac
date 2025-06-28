<?php

use App\Http\Controllers\Actions\RolesController;
use App\Http\Controllers\Actions\UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [PagesController::class, 'index'])->name('index');
    
});
Route::middleware(['auth', 'permission'])->group(function () {
    Route::get('users', [PagesController::class, 'users'])->name('users');
});

Route::middleware(['auth', 'permission:create'])->group(function () {
    Route::get('users/create', [UsersController::class, 'index'])->name('users.index');
    Route::post('users', [UsersController::class, 'store'])->name('users.store');
});

Route::middleware(['auth', 'permission:update'])->group(function () {
    Route::get('users/edit/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::post('users/update', [UsersController::class, 'update'])->name('users.update');
});

Route::middleware(['auth', 'permission:delete'])->group(function () {
    Route::post('users/delete', [UsersController::class, 'destroy'])->name('users.delete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('roles', [PagesController::class, 'roles'])->name('roles');
    Route::get('roles/create', [RolesController::class, 'index'])->name('roles.index');
    Route::post('roles', [RolesController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [RolesController::class, 'show'])->name('roles.show');
    Route::post('roles/update', [RolesController::class, 'update'])->name('roles.update');
    Route::post('roles/delete', [RolesController::class, 'destroy'])->name('roles.delete');

});
Route::get('login', [PagesController::class, 'login'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');