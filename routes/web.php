<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/home', [SiteController::class, 'home']); // Alias pentru / 
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact.page');
Route::get('/services', [SiteController::class, 'services'])->name('services');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/article/{category}/{id}', function ($category, $id) {
    return "Categorie: $category, Articol ID: $id";
});

Route::get('/admin', [SiteController::class, 'admin'])->middleware(['auth', 'isAdmin'])->name('admin');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/users', function () {
        return "Admin Users";
    });

    Route::get('/settings', function () {
        return "Admin Settings";
    });
});

