<?php
use App\Http\Controllers\CustomloginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('customLogin');
});

require __DIR__ . '/auth.php';

Route::get('/customlogin', [CustomloginController::class, 'index'])->name('customLogin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //menu routes
    Route::get('/menu_list', [MenuController::class, 'getAllMenu'])->name('getAllMenu');
    Route::get('/add_menu', [MenuController::class, 'add_menu'])
        ->name('menu.add');
    //anyone can see but not post menu
    Route::get('/deleteMenu/{id}', [MenuController::class, 'deleteMenu'])->name('deleteMenu');

    //default route by laravel breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route which can access by anyone
//post routes
Route::get('/getpost', [PostController::class, 'index'])->name('getpost');
Route::post('/createpost', [PostController::class, 'store'],)->name('createpost');
Route::get('/all_posts', [PostController::class, 'index'])->name('post.post');
Route::get('/add_posts', function () {
    return view('post.addpost');
})->name('add_posts');




//by role permission

Route::middleware(['auth', 'verified', 'usertype:admin',])->prefix('admin')->group(function () {

    //menu routes which can only access by admin
    Route::post('/add_menu', [MenuController::class, 'storeMenu'])->name('storeMenu');
    // show edit form, if it is not admin then user can not go to using that button
    Route::get('/editMenu/{id}', [MenuController::class, 'editMenu'])
        ->name('editMenu');
    Route::put('/editedMenu/{id}', [MenuController::class, 'updateMenu'])
        ->name('editedMenu');

    //for approving posts
    Route::get('/post/index', [PostController::class, 'index'])->name('getAllPost');

    Route::get('/edit_post/{id}', [PostController::class, 'edit'])->name('editPost');
    //in the below they are not working
    Route::put('/edit_posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::put('/approve_post/{id}', [PostController::class, 'approve'])->name('posts.approve');
});
