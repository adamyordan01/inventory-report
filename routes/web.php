<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;

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

Route::middleware(['auth'])->group(function() {
    
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    // Route::resource('item', ItemController::class);
    Route::get('/', DashboardController::class)->name('dashboard');
    
    Route::resource('/category', CategoryController::class)->middleware('can:isAdmin');
    
    Route::resource('/product', ProductController::class);
    Route::any('/product/{product}/save', [ProductController::class, 'save'])->name('product.save');
    Route::any('/product/{product}/print', [ProductController::class, 'print'])->name('product.print');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password');
    Route::patch('password-update', [PasswordController::class, 'update'])->name('password-update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile-update', [ProfileController::class, 'update'])->name('profile-update');
    
});
