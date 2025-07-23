<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

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

// Route::get('/register-form', function () {
//     return view('main');
// });

// Route::get('/apply-test', function () {
//     return view('test');
// });

// Route::get('/template-form', function () {
//     return view('template');
// });

Route::get('/', function () {
    return redirect('/apply-form');
});

Route::get('/apply-form', [ApplicationController::class,'index'])->name('index');


Route::post('/store', [ApplicationController::class,'store'])->name('store');

// Route Fallback
Route::fallback(function () {
    return redirect('/apply-form');
});

