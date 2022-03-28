<?php

use Illuminate\Support\Facades\Route;

/**
 * Controllers
 */

use App\Http\Controllers\EventController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\MyPageController;

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

// for API socket
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
// 	return view('dashboard');
// })->name('dashboard');

Route::prefix('manager')
	->middleware('can:manager-higher')
	->group(function () {

		Route::get('events/past', [EventController::class, 'past'])
			->name('events.past');
		Route::get('events/deleted', [EventController::class, 'deleted'])
			->name('events.deleted');
		Route::post('events/deleted/{event}', [EventController::class, 'completeDestroy'])
			->name('events.completeDestroy');
		Route::post('events/deleted/{event}', [EventController::class, 'restore'])
			->name('events.restore');

		Route::resource('events', EventController::class);
	});

Route::middleware('can:user-higher')
	->group(function () {
		Route::get('/dashboard', [ReservationController::class, 'dashboard'])
			->name('dashboard');
		Route::get('/mypage', [MyPageController::class, 'index'])
			->name('mypage.index');
		Route::get('/mypage/{id}', [MyPageController::class, 'show'])
			->name('mypage.show');
		Route::post('/mypage/{id}', [MyPageController::class, 'cancel'])
			->name('mypage.cancel');
		// Route::get('/{id}', [ReservationController::class, 'detail'])
		// 	->name('events.detail');
		Route::post('/{id}', [ReservationController::class, 'reserve'])
			->name('events.reserve');
	});

Route::middleware('auth')
	->get('/{id}', [ReservationController::class, 'detail'])
	->name('events.detail');
