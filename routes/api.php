<?php

use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/getListApplication', [\App\Http\Controllers\ApiController::class, 'index'])->name('application.index');
Route::get('/getApplicationDetail/{id}', [\App\Http\Controllers\ApiController::class, 'show'])->name('application.show');
Route::put('/updateApplicationStatus/{id}', [\App\Http\Controllers\ApiController::class, 'update'])->name('application.update');
Route::get('/provinces',[LocationController::class,'getProvinces'])->name('provinces');
Route::get('/amphoes',[LocationController::class,'getAmphoes'])->name('amphoes');
Route::get('/tambons',[LocationController::class,'getTambons'])->name('tambons');
Route::get('/zipcodes',[LocationController::class,'getZipcodes'])->name('zipcodes');
