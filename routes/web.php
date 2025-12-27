<?php

use App\Http\Controllers\CustomloginController;
use App\Http\Controllers\MenuController;
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
    Route::get('/add_menu', [MenuController::class, 'add_menu'])
        ->name('menu.add');

    Route::post('/add_menu', [MenuController::class, 'storeMenu'])->name('storeMenu');


    // Route::get('/editMenu/{id}', [MenuController::class, 'editMenu'])
    //     ->name('editMenu');

    // Route::put('/editedMenu/{id}', [MenuController::class, 'updateMenu'])
    //     ->name('editedMenu');

    //updated
    // show edit form
    Route::get('/editMenu/{id}', [MenuController::class, 'editMenu'])
        ->name('editMenu');

    // update menu (PUT)
    Route::put('/editedMenu/{id}', [MenuController::class, 'updateMenu'])
        ->name('editedMenu');



    // Route::delete('/menu_delete/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');

    Route::get('/deleteMenu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');



    Route::get('/menu_list', [MenuController::class, 'getAllMenu'])->name('getAllMenu');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
