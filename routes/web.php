<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MenuController::class, 'index'])->name('dashboard');
Route::get('/add_menu', [MenuController::class, 'add_menu']);

//for adding the menu route
Route::post('/menucreate', [MenuController::class, 'storeMenu'])->name('storeMenu');

//for get all the menu
Route::get('/menu_list', [MenuController::class, 'getAllMenu'])->name('getAllMenu');

Route::get('/menu_edit/{id}', [MenuController::class, 'editMenu'])->name('editMenu');
