<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
})->name('contact.page');


Route::get('/login', function () {
    return view('login');
    
});

Route::post('/login', function () {
    return "Autentificare...";
});

Route::get('/user/{id}', function ($id) {
    return "Profil utilizator cu ID = " . $id;
});

Route::get('/article/{category}/{id}', function ($category, $id) {
    return "Categorie: $category, Articol ID: $id";
});

Route::prefix('admin')->group(function () {

    Route::get('/', function () {
        return "Admin Dashboard";
    });

    Route::get('/users', function () {
        return "Admin Users";
    });

    Route::get('/settings', function () {
        return "Admin Settings";
    });

});
