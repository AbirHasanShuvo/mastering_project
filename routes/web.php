<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [MenuController::class, 'index']);
Route::get('/add_menu', [MenuController::class, 'add_menu']);
