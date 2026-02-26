<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/krajowa', [HomeController::class, 'krajowa'])->name('krajowa');
Route::post('/krajowa/oblicz-podroze', [HomeController::class, 'krajowaObliczPodroze'])->name('krajowa.calculate-trip');
Route::post('/krajowa/oblicz-rachunek', [HomeController::class, 'krajowaObliczRachunek'])->name('krajowa.calculate-bill');
Route::get('/zagraniczna', [HomeController::class, 'zagraniczna'])->name('zagraniczna');
Route::get('/pomoc', [HomeController::class, 'pomoc'])->name('pomoc');
Route::get('/kontakt', [HomeController::class, 'kontakt'])->name('kontakt');
Route::post('/kontakt-uj', [ContactController::class, 'store'])->middleware(['honey'])->name('contact.store');
Route::get('/podstawa', [HomeController::class, 'podstawa'])->name('podstawa');
