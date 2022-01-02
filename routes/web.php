<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontEnd\PostController;
use App\Http\Controllers\FrontEnd\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[LoginController::class,'showLoginForm']);

Auth::routes();


Route::group(['middleware' => ['auth:web']], function () {

    Route::get('my-profile', [UserController::class, 'myProfile'])->name('my.profile');
    Route::get('profile/{user}', [UserController::class, 'profile'])->name('user.profile');
    Route::get('profiles', [UserController::class, 'profiles'])->name('user.profiles');
    Route::get('following', [UserController::class, 'folowing'])->name('user.folowing');
    Route::get('followers', [UserController::class, 'followers'])->name('user.followers');
    Route::put('follow/{user}', [UserController::class, 'follow'])->name('user.follow');

    Route::resource('posts', PostController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::get('error', [UserController::class,'technicalIssue'])->name('user.technicalIssue');
});
