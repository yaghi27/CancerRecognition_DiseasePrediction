<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\LoginGoogleController;
use App\Http\Controllers\Main\CT_scanController;
use App\Http\Controllers\Main\Disease_predictionController;
use App\Http\Controllers\Main\Home_pageController;
use App\Http\Controllers\Main\History_pageController;
use Laravel\Socialite\Facades\Socialite; 
use App\Models\User; 

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

// -------------------------------------------AUTHENTICATION -----------------------------------


    Route::post('/auth/register', [AuthController::class, 'createUser']);
    Route::post('/auth/login', [AuthController::class, 'loginUser']);
    Route::get('/auth/logout', [AuthController::class, 'logoutUser'])->name('/auth/logout');

    Route::get('login', function () {
        return view('Authentication/login');
    })->name('login');

    Route::get('register', function () {
        return view('Authentication/register');
    });

    // ------------------------------------------- Google -----------------------------------
        Route::get('/login/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login/google'); 
        Route::get('callback/google',[LoginGoogleController::class, 'handleGoogleCallback']);//->name('callback/google'); 
    // ------------------------------------------- END Google -----------------------------------
// ------------------------------------------END AUTHENTICATION ---------------------------------





// ------------------------------------------MAIN PAGES -----------------------------------


    // ----------------------------------------Home Page---------------------------------------------------
        Route::get('home', [Home_pageController::class, 'index'])->name('home');
    // ----------------------------------------End Home Page------------------------------------------------


    // ----------------------------------------DISEASE PREDICITON---------------------------------------------------
        Route::get('disease_prediction', [Disease_predictionController::class, 'index'])->name('disease_prediction');
        Route::post('disease_prediction/predict', [Disease_predictionController::class, 'disease_prediction_form_submit'])->name('disease_prediction/predict');
    // ----------------------------------------END DISEASE PREDICITON------------------------------------------------

    // ----------------------------------------Home Page---------------------------------------------------
        Route::get('history', [History_pageController::class, 'index'])->name('history');
    // ----------------------------------------End Home Page------------------------------------------------

    // ----------------------------------------DISEASE PREDICITON---------------------------------------------------
        Route::get('ct_scan', [CT_scanController::class, 'index'])->name('ct_scan');
        Route::post('ct_scan/send_mri', [CT_scanController::class, 'send_mri'])->name('ct_scan/send_mri');
    // ----------------------------------------END DISEASE PREDICITON------------------------------------------------

    Route::get('contact_us', function () {
        return view('Main/contact_us');
    })->name('contact_us');

// ----------------------------------------END MAIN PAGE -------------------------------