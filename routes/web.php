<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;



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
    return view('home');
})->name('home');

Route::get('/home2', function () {
    return view('home2');
})->name('home2');

Route::get('/mobile-ios/inAppSuccess', function () {
    return view('mobile-ios/inAppSuccess');
});


Route::get('/mobile-ios/inAppExpired', function () {
    return view('mobile-ios/inAppExpired');
});

Route::get('splash', function () {
    return view('splash');
})->name('splash');

///////////////////
///////////////////
/// BENUTZER
///////////////////
///////////////////
Route::post('user.anlegen', [UserController::class, 'userAnlegen'])->name('user.anlegen');
Route::post('user.messungEintragen', [UserController::class, 'messungEintragen'])->name('user.messungEintragen')->middleware(['auth', 'verified']);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);






