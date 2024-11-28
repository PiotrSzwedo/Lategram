<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

Auth::routes();

// ---------------------------
// Home Routes
// ---------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// ---------------------------
// Comment Routes
// ---------------------------
Route::post('/comment/add', [CommentController::class, 'storage'])->name('add_comment');

// ---------------------------
// Profile Routes
// ---------------------------
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::get('/{name}', [ProfileController::class, 'show'])->name('show-profile');
    Route::patch('/{user}', [ProfileController::class, 'update']);
    Route::post('/search', [ProfileController::class, 'search']);
    Route::get('/search/user', [ProfileController::class, 'searchUser'])->name('search-user');
});

// Account-specific profile editing
Route::get('/account/profile/edit', [ProfileController::class, 'editProfile'])->name('edit-profile');

// ---------------------------
// Post Routes
// ---------------------------
Route::prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create-post');
    Route::post('/', [PostController::class, 'storage']);
});

// ---------------------------
// Follow Routes
// ---------------------------

Route::prefix('follow')->group(function () {
    Route::post("/{profile}", [FollowController::class, 'follow']);
    Route::post("/un/{profile}", [FollowController::class, 'unFollow']);
});
