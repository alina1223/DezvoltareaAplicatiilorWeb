<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/home', [SiteController::class, 'home']); 
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact.page');
Route::get('/services', [SiteController::class, 'services'])->name('services');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ===================== API ROUTES PENTRU SERVICII (CRUD) =====================

// GET - Afiseaza toate serviciile
Route::get('/api/services', [ServiceController::class, 'index']);

// GET - Afiseaza un serviciu dupa ID
Route::get('/api/services/{id}', [ServiceController::class, 'show']);

// POST - Creeaza un serviciu nou
Route::post('/api/services', [ServiceController::class, 'store']);

// PUT/PATCH - Actualizeaza un serviciu
Route::put('/api/services/{id}', [ServiceController::class, 'update']);
Route::patch('/api/services/{id}', [ServiceController::class, 'update']);

// DELETE - Sterge un serviciu
Route::delete('/api/services/{id}', [ServiceController::class, 'destroy']);

// ===================== RUTE DE FILTRARE SI SORTARE =====================

// GET - Filtreaza serviciile dupa categorie
Route::get('/api/services/category/{categoryId}', [ServiceController::class, 'filterByCategory']);

// GET - Sorteaza serviciile dupa pret (asc/desc)
Route::get('/api/services/sort/{order}', [ServiceController::class, 'sortByPrice']);

// GET - Serviciile cu pret mai mic decat o valoare
Route::get('/api/services/price-range/{maxPrice}', [ServiceController::class, 'priceRange']);

// GET - Statistici despre servicii
Route::get('/api/statistics', [ServiceController::class, 'statistics']);

// ===================== RUTE PENTRU CATEGORII =====================

Route::get('/api/categories', function () {
    return response()->json([
        'success' => true,
        'data' => \App\Models\ServiceCategory::with('services')->get()
    ]);
});

Route::get('/api/categories/{id}', function ($id) {
    $category = \App\Models\ServiceCategory::with('services')->find($id);
    
    if (!$category) {
        return response()->json([
            'success' => false,
            'message' => 'Categoria nu a fost gasita'
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data' => $category
    ]);
});

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


