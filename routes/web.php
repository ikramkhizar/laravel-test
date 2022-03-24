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
Route::get('/welcome/{id}', [App\Http\Controllers\WelcomeController::class, 'show'])->name('add_product');
Route::post('/welcome', [App\Http\Controllers\WelcomeController::class, 'store'])->name('save_product');

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(AllowAdmin::class);
