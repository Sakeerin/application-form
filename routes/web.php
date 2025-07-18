<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\ApplicationController;

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

Route::get('/register-form', function () {
    return view('main');
});

Route::get('/apply-form', function () {
    return view('test');
});

Route::get('/template-form', function () {
    return view('template');
});
Route::post('/store', [ApplicationController::class,'store'])->name('store');

