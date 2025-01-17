<?php

use App\Http\Controllers\PostController;
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

Route::get('posts', [
    PostController::class,
    'index'
]);

Route::get('posts/create', [
    PostController::class,
    'create'
]);

Route::post('posts', [
    PostController::class,
    'storage'
]);

Route::get('posts/{id}', [
    PostController::class,
    'edit'
]);

Route::put('posts/{id}', [
    PostController::class,
    'update'
]);

Route::delete('posts/{id}', [
    PostController::class,
    'delete'
]);


