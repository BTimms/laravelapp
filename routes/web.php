<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function(){
//    return view('welcome');
//});

Route::get('/', [\App\Http\Controllers\PagesController::class, 'index']);

Route::resource('posts', PostsController::class);

// Redirect /home to /posts or another appropriate route
Route::get('/home', function() {
    return redirect('/posts');
});

// Authentication routes
Auth::routes();

// Dashboard route, handled by DashboardController's index method
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
