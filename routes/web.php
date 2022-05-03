<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScrapperController;

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
    return view('welcome');
});

Route::get('scrape', [ScrapperController::class, 'index']);
Route::post('scrape-and-store', [ScrapperController::class, 'scrapeAndStore'])->name('scrapper.store');
Route::get('screenshot', [ScrapperController::class, 'screenshot']);
