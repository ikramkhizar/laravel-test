<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AllowAdmin;

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

Route::redirect('/', '/login');

Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');
Route::get('/welcome/{id}', [App\Http\Controllers\WelcomeController::class, 'create'])->name('add_product');
Route::post('/welcome', [App\Http\Controllers\WelcomeController::class, 'store'])->name('save_product');
Route::get('/my_products', [App\Http\Controllers\WelcomeController::class, 'show'])->name('my_products');
Route::get('/edit_product/{id}', [App\Http\Controllers\WelcomeController::class, 'edit'])->name('edit_product');
Route::put('/update_product/{id}', [App\Http\Controllers\WelcomeController::class, 'update'])->name('update_product');

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(AllowAdmin::class);
