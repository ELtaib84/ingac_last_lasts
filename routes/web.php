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

Route::get('/', function () {
    return view('user.home');
});
Route::get('/whoare', function () {
    return view('user.whoare');
});
Route::get('/contact', function () {
    return view('user.contact');
});
Route::get('/service', function () {
    return view('user.service');
});

