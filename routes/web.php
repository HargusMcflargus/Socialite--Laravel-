<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = Post::all();
    return view('dashboard', [
        'posts' => $posts
    ]);
});

Route::get('/dashboard', function () {
    $posts = Post::all();
    return view('dashboard', [
        'posts' => $posts
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/createPost', [ PostController::class, 'store'])->name('createPost');
Route::get('/myPosts', [ PostController::class, 'getMyPosts'])->name('posts');
Route::delete('/removePost', [ PostController::class, 'removePost'])->name('removePost');
Route::put('/updatePost', [ PostController::class, 'update'])->name('updatePost');

require __DIR__.'/auth.php';
