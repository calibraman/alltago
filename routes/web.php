<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
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


Route::group(['middleware' => 'auth'], function () {
    // Hier kommen die Routen, die eine aktive Sitzung erfordern

    Route::get('/home', function () {
        return view('home2');
    })->name('home2')->middleware(['auth', 'verified']);

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
    Route::post('user.einstellungenSpeichern', [UserController::class, 'einstellungenSpeichern'])->name('user.einstellungenSpeichern')->middleware(['auth', 'verified']);
    Route::post('user.logout', [UserController::class, 'logout'])->name('user.logout')->middleware(['auth', 'verified']);
    Route::post('user.passwortAendern', [UserController::class, 'benutzerPasswortAendern'])->name('user.passwortAendern');

    Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

});

// Falls keine aktive Sitzung existiert, wird der Benutzer zur Login-Seite umgeleitet.


Route::post('loginKai', [LoginController::class, 'loginKai'])->name('loginKai');
Route::post('user.passwortZuruecksetzen', [UserController::class, 'benutzerPasswortZuruecksetzen'])->name('user.passwortZuruecksetzen');


Route::get('splash', function () {
    return view('splash');
})->name('splash');


Route::get('/', function () {

    Route::middleware(['auth', 'verified'])->group(function () {
        return view('splash');
    });

    return view('detect');
    //return redirect('https://www.google.de');
});



