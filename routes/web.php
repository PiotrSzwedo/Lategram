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

Route::get('/profile/', [App\Http\Controllers\ProfilesController::class, 'index']);

Route::get('/profile/{name}', [App\Http\Controllers\ProfilesController::class, 'show']);

Route::get('account/profile/edit', [App\Http\Controllers\ProfilesController::class, 'editProfile']);

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create']);

Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show']);

Route::post('/post',  [App\Http\Controllers\PostController::class, 'storage']);

Route::patch("/profile/{user}", [App\Http\Controllers\ProfilesController::class, 'update']);
