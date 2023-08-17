<?php

use App\Http\Controllers\SliderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'app');

Route::view('/about', 'app');

Route::view('/admin/slider', 'app');

Route::view('/admin/slider/create', 'app');

Route::view('/admin/slider/update/{id}', 'app');

Route::view('/login', 'app');



Route::get('get/slider', [SliderController::class, 'getAllData']);
