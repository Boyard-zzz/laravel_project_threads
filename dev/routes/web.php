<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;
use App\Http\Middleware\EnsureUserIsAdmin;
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
Route::get('/replies/{reply}/edit', [ReplyController::class, 'edit'])->name('replies.edit');
Route::put('/replies/{reply}', [ReplyController::class, 'update'])->name('replies.update');

Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');

Route::middleware(['auth', EnsureUserIsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
    Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
});

Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');

Route::middleware('auth')->group(function () {
    Route::get('/threads/{thread}/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/threads/{thread}/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::post('/topics/{topic}/replies', [ReplyController::class, 'store'])->name('replies.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
