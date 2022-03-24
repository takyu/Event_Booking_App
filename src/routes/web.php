<?php

use Illuminate\Support\Facades\Route;

/**
 * Controllers
 */

use App\Http\Controllers\EventController;

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

Route::get('/', fn () => view('welcome'));

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');

Route::prefix('manager')
	->middleware('can:manager-higher')
	->group(function () {
		Route::resource('events', EventController::class);
	});

Route::middleware('can:user-higher')
	->group(function () {
		Route::get('index', fn () => dd('user'));
	});
