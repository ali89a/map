<?php

use App\Models\Location;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LocationController;

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
    $locations = Location::all();
    return view('welcome', compact('locations'));
});
Route::get('/dashboard', [WelcomeController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::get('/map-marker', [LocationController::class, 'mapMarker']);
Route::resource('locations', LocationController::class)->middleware(['auth']);
require __DIR__ . '/auth.php';
