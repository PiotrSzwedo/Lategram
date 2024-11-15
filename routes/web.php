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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/profile/{name}', [App\Http\Controllers\ProfileController::class, 'show']);

Route::patch("/profile/{user}", [App\Http\Controllers\ProfileController::class, 'update']);

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name("create-post");

Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show']);

Route::post('/post',  [App\Http\Controllers\PostController::class, 'storage']);

Route::get('/account/profile/edit', [App\Http\Controllers\ProfileController::class, 'editProfile'])->name("edit-profile");
