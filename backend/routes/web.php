<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\TrashController;
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

Route::controller(TopController::class)->group(function() {
    Route::get('/','top')->name('top');
    Route::get('/article/{post_id}','articleShow')->name('top.article.show');
    Route::get('/article/category/{category_id}','articleCategory')->name('top.article.category');
});

Route::controller(PostController::class)->group(function() {
    Route::get('/user/{id}/index','index')->name('user.index');
    Route::get('/post/create','create')->name('post.create');
    Route::post('/post/store','store')->name('post.store');
    Route::get('/post/show/{post_id}','show')->name('post.show');
    Route::get('/post/edit/{post_id}','edit')->name('post.edit');
    Route::post('/post/update/{post_id}','update')->name('post.update');
});

Route::controller(TrashController::class)->group(function() {
    Route::get('/post/trash','trashList')->name('post.trash');
    Route::post('/post/trash/{post_id}','moveTrash')->name('post.move.trash');
    Route::post('/post/restore/{post_id}','restore')->name('post.restore');
    Route::post('/post/delete/{post_id}','delete')->name('post.delete');
});

//トップ画面
// Route::get('/',[TopController::class,'top'])
// ->name('top');
// //トップ画面記事詳細
// Route::get('/article/{post_id}',[TopController::class,'articleShow'])
// ->name('top.article.show');
// //トップ画面カテゴリーごとの表示
// Route::get('article/category/{category_id}',[TopController::class,'articleCategory'])
// ->name('top.article.category');

// Route::get('/user/{id}/index',[PostController::class,'index'])
// ->name('user.index');

// Route::get('/post/create', [PostController::class,'create'])
// ->name('post.create');

// Route::post('/post/store',[PostController::class,'store'])
// ->name('post.store');

// Route::get('/post/show/{post_id}',[PostController::class,'show'])
// ->name('post.show');

// Route::get('/post/edit/{post_id}',[PostController::class,'edit'])
// ->name('post.edit');
// Route::post('/post/update/{post_id}',[PostController::class,'update'])
// ->name('post.update');

// Route::get('/post/trash',[TrashController::class,'trashList'])
// ->name('post.trash');
// Route::post('/post/trash/{post_id}',[TrashController::class,'moveTrash'])
// ->name('post.move.trash');
// Route::post('/post/restore/{post_id}',[TrashController::class,'restore'])
// ->name('post.restore');
// Route::post('/post/delete/{post_id}',[TrashController::class,'delete'])
// ->name('post.delete');