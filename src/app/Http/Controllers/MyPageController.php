<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Facades
 */

use Illuminate\Support\Facades\Auth;

/**
 * Carbon
 */

use Carbon\Carbon;

/**
 * Models
 */

use App\Models\User;
use App\Models\Reservation;
use App\Models\Event;

/**
 * Services
 */

use App\Services\MyPageService;

class MyPageController extends Controller
{
	public function index()
	{
		$user = User::findOrFail(Auth::id());
		$events = $user->events;

		$fromTodayEvents = MyPageService::reservedEvent($events, \MyPageConst::FROM_TODAY);
		$pastEvents = MyPageService::reservedEvent($events, \MyPageConst::PAST);

		return view('mypage.index', compact('fromTodayEvents', 'pastEvents'));
	}

	public function show($id)
	{
		$event = Event::findOrFail($id);

		$reservation = Reservation::where('user_id', '=', Auth::id())
			->where('event_id', '=', $id)
			->latest()
			->first();

		return view('mypage.show', compact('event', 'reservation'));
	}

	public function cancel($id)
	{
		$reservation = Reservation::where('user_id', '=', Auth::id())
			->where('event_id', '=', $id)
			->latest()
			->first();

		$reservation->canceled_date = Carbon::now()->format('Y-m-d H:i:s');
		$reservation->save();

		session()->flash('status', 'キャンセルしました。');
		return to_route('dashboard');
	}
}
