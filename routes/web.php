<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// __dir project.php
require __DIR__ .'/project.php';
require __DIR__ .'/topic.php';
require __DIR__ .'/anketa.php';
require __DIR__ .'/risk.php';
require __DIR__ .'/question.php';
require __DIR__ .'/action.php';
require __DIR__ .'/test.php';
// resourse routes ImgController
Route::resource('img',App\Http\Controllers\ImgController::class);
