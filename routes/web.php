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

/*
Route::get('/', function () {
    return view('home2');
})->name('home2')->middleware(['auth', 'verified']);
*/
Route::get('/home2', function () {
    return view('home2');
})->name('home2')->middleware(['auth', 'verified']);

Route::get('/home3', function () {
    return view('home3');
})->name('home3')->middleware(['auth', 'verified']);

Route::get('/einstellungen', function () {
    return view('/einstellungen');
})->name('/einstellungen')->middleware(['auth', 'verified']);

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
Route::post('user.messungBearbeiten', [UserController::class, 'messungBearbeiten'])->name('user.messungBearbeiten')->middleware(['auth', 'verified']);
Route::post('user.messungLoeschen', [UserController::class, 'messungLoeschen'])->name('user.messungLoeschen')->middleware(['auth', 'verified']);
Route::post('user.holeFeed', [UserController::class, 'holeFeed'])->name('user.holeFeed')->middleware(['auth', 'verified']);
Route::post('user.holeFeed2', [UserController::class, 'holeFeed2'])->name('user.holeFeed2')->middleware(['auth', 'verified']);
Route::post('user.holeFeedWochenbuch', [UserController::class, 'holeFeedWochenbuch'])->name('user.holeFeedWochenbuch')->middleware(['auth', 'verified']);
Route::post('user.crop-userimage-upload', [UserController::class, 'uploadCropImage'])->name('user.crop-userimage-upload')->middleware(['auth', 'verified']);




Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);





Route::get('/', function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        return view('home2');
    });

    return view('home2');
   // return redirect('https://www.alltago.app');
});



