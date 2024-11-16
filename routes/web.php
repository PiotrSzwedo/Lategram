<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/profile/{name}', [App\Http\Controllers\ProfileController::class, 'show'])->name("show-profile");

Route::patch("/profile/{user}", [App\Http\Controllers\ProfileController::class, 'update']);

Route::post("/profile/search/", [App\Http\Controllers\ProfileController::class, 'search']);

Route::get("/profile/search/user", [App\Http\Controllers\ProfileController::class, 'searchUser'])->name("search-user");

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name("create-post");

Route::post('/post',  [App\Http\Controllers\PostController::class, 'storage']);

Route::get('/account/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name("edit-profile");
