<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\User\PostController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/',[TopController::class,'top'])
->name('top');

Route::get('/user/{id}/index',[PostController::class,'index'])
->name('user.index');

Route::get('/post/create', [PostController::class,'create'])
->name('post.create');

Route::post('/post/store',[PostController::class,'store'])
->name('post.store');