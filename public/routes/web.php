<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LotController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CustomAuthCheck;
use App\Http\Controllers\BetController;


Route::get('/', [PageController::class, 'index'])->name('main-page');
Route::get('/lots/{id}', [PageController::class, "single"])->name('lot-page');

Route::get('/lots/category/{id}', [LotController::class, "searchByCategory"])->name('category-search');
Route::get('/search',[LotController::class, "search"])->name('search');

Route::get('/sign-up', [PageController::class,"signup"])->name('signup-page');
Route::post('/sign-up', [UserController::class,"signup"])->name('signup');

Route::get('/login', [PageController::class, "login"])->name('login-page');
Route::post('/login', [UserController::class, "login"])->name('login');
Route::get('/logout', [UserController::class, "logout"])->name('logout');

Route::get('/addlot', [PageController::class, "addlot"])->name('addlot-page')->middleware(CustomAuthCheck::class);
Route::post('/addlot', [LotController::class, 'addlot'])->name('addlot')->middleware(CustomAuthCheck::class);

Route::get('/profile', [PageController::class, 'profile'])->name('profile')->middleware(CustomAuthCheck::class);

Route::post('/lots/{lotId}/create-bet', [BetController::class, "placeBet"])->name('lot-place-bet')->middleware(CustomAuthCheck::class);
