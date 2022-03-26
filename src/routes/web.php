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

Route::get('/', fn () => view('calender'));

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
	return view('dashboard');
})->name('dashboard');

Route::prefix('manager')
	->middleware('can:manager-higher')
	->group(function () {

		Route::get('events/past', [EventController::class, 'past'])
			->name('events.past');
		Route::get('events/deleted', [EventController::class, 'deleted'])
			->name('events.deleted');
		Route::post('events/deleted/completeDestroy/{event}', [EventController::class, 'completeDestroy'])
			->name('events.completeDestroy');
		Route::post('events/deleted/restore/{event}', [EventController::class, 'restore'])
			->name('events.restore');

		Route::resource('events', EventController::class);
	});

Route::middleware('can:user-higher')
	->group(function () {
		Route::get('index', fn () => dd('user'));
	});
