<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;

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
    Route::get('/{name}/offset/{offset}', [ProfileController::class, "showWithOffset"]);
    Route::patch('/{user}', [ProfileController::class, 'update']);
    Route::post('/search', [ProfileController::class, 'search']);
    Route::get('/search/user', [ProfileController::class, 'searchUser'])->name('search-user');
});

// ---------------------------
// Account routes
// ---------------------------
Route::prefix('account')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::get('/account/edit', [ProfileController::class, 'editProfile'])->name('edit-account');
});

// ---------------------------
// Post Routes
// ---------------------------
Route::prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create-post');
    Route::post('/', [PostController::class, 'storage']);
    Route::post('/get/', [PostController::class, 'show']);
});

// ---------------------------
// Follow Routes
// ---------------------------

Route::prefix('follow')->group(function () {
    Route::post("/{profile}", [FollowController::class, 'follow']);
    Route::post("/un/{profile}", [FollowController::class, 'unFollow']);
    Route::get("/my", [FollowController::class, 'show']);
});

// ---------------------------
// Like Routes
// ---------------------------

Route::prefix('like')->group(function () {
    Route::post('/add/', [LikeController::class, 'storage']);
    Route::post('/un/', [LikeController::class, 'unLike']);
});