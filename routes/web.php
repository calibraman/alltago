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

//$parameters = request()->all();
// Display all GET parameters
//dd($parameters);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mobile-ios/inAppSuccess', function () {
    return view('mobile-ios/inAppSuccess');
});


Route::get('/mobile-ios/inAppExpired', function () {
    return view('mobile-ios/inAppExpired');
});





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
