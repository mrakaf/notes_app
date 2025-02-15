<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::get('/', [NoteController::class, 'create'])->name('notes.create');

// Auth routes
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route khusus untuk login & save note
Route::post('/login-save-note', [AuthController::class, 'loginAndSaveNote'])->name('login.save.note');

// Notes routes dengan auth middleware
Route::middleware('auth')->group(function () {
    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::get('/notes/createC', [NoteController::class, 'createC'])->name('notes.createC');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/notes/{note}/edit1', [NoteController::class, 'edit1'])->name('notes.edit1');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');
    Route::get('/notes/search', [NoteController::class, 'search'])->name('notes.search');
    Route::get('/notes/export', [NoteController::class, 'export'])->name('notes.export');
    Route::get('/notes/history', [NoteController::class, 'history'])->name('notes.history');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/notes/{note}/download/txt', [NoteController::class, 'downloadTXT'])->name('notes.download.txt');
});

Route::middleware('web')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-save-note', [AuthController::class, 'loginAndSaveNote'])->name('login.save.note');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
});
