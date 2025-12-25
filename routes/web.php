<?php

use App\Http\Controllers\CustomloginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('customLogin');
});

require __DIR__ . '/auth.php';


//in the below this is custom login route
Route::get('/customlogin', [CustomloginController::class, 'index'])->name('customLogin');


Route::get('/dummy_admin', function () {
    return view('dummy_admin');
})->name('dummyadmin');


Route::get('/dummy_user', function () {
    return view('dummy_user');
})->name('dummyuser');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
