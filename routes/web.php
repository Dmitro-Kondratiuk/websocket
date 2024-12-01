<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/register', [UsersController::class, 'register'])->name('register');
Route::post('/register_user', [UsersController::class, 'registerUser'])->name('user.register');
Route::get('/login', [UsersController::class, 'login'])->name('login');
Route::post('/login_user', [UsersController::class, 'loginUser'])->name('user.login');

Route::middleware('auth.user')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('home');
    Route::get('/posts/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostsController::class, 'store'])->name('post.store');
    Route::get('friends',[UsersController::class, 'friends'])->name('friends');
    Route::get('/logout',[UsersController::class, 'logout'])->name('user.logout');
    Route::post('/friend/add/{user}',[UsersController::class, 'addFried'])->name('friend.add');

    Route::get('/chats', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chats', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chats/{chat}/messages', [ChatController::class, 'sendMessage'])->name('chat.storeMessage');
});
