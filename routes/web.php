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

Route::get('/', function () {
    // return view('welcome');
    return view('auth.login');
})->middleware('guest');

Auth::routes(['verify' => true]);

Route::middleware(['verified'])->group(function(){
  Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  Route::post('/post/comment/store', 'CommentController@store')->name('comment.store');
  Route::get('/mypost', 'HomeController@mypost')->name('home.mypost');
  Route::get('/mycomment', 'HomeController@mycomment')->name('home.mycomment');
  //プロファイルの編集
  Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('profile.edit');
  Route::put('/profile/{user}', 'ProfileController@update')->name('profile.update');


// 管理者用画面
Route::middleware(['can:admin'])->group(function() {
    Route::get('/profile/index', 'ProfileController@index')->name('profile.index');
    Route::delete('/profile/{user}', 'ProfileController@delete')->name('profile.delete');
  });  
  
});

Route::resource('/post','PostController');