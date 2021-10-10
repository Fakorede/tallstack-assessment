<?php

use App\Http\Controllers\ExportsController;
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

Route::redirect('/', 'dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'staff', 'middleware' => ['auth']], function() {
    Route::get('/', function() {
        return view('staff');
    })->name('staff');
    Route::get('/add', function() {
        return view('add-staff');
    })->name('add-staff');
});

Route::group(['prefix' => 'patient', 'middleware' => ['auth']], function() {
    Route::get('/', function() {
        return view('patient');
    })->name('patient');
    Route::get('/add', function() {
        return view('add-patient');
    })->name('add-patient');
    Route::get('/{patient}/add-observation', function() {
        return view('add-patient-observation');
    })->name('add-patient-observation');
});

require __DIR__.'/auth.php';
