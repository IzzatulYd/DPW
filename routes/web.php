<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KontrakController;

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

Route::get('/', [KontrakController::class, 'index']);
Route::resource('/kontraks', KontrakController::class);
Route::get('/getJabatan', [KontrakController::class, 'getJabatan']);
Route::get('/getPegawai', [KontrakController::class, 'getPegawai']);

