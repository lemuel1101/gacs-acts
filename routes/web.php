<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/accounting', function () {
        return view('accounting.content');
    })->name('accounting');

    Route::get('/journal', function () {
        return view('accounting.journal');
    })->name('journal');
});
