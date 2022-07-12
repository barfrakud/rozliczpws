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

// Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/krajowa', [App\Http\Controllers\HomeController::class, 'krajowa'])->name('krajowa');

Route::get('/zagraniczna', [App\Http\Controllers\HomeController::class, 'zagraniczna'])->name('zagraniczna');

Route::get('/pomoc', [App\Http\Controllers\HomeController::class, 'pomoc'])->name('pomoc');

Route::get('/kontakt', [App\Http\Controllers\HomeController::class, 'kontakt'])->name('kontakt');

Route::get('/podstawa', [App\Http\Controllers\HomeController::class, 'podstawa'])->name('podstawa');
