<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Facades
 */

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Models
 */

use App\Models\Event;
use App\Models\Reservation;

/**
 * Services
 */

use App\Services\ReservationService;

class ReservationController extends Controller
{
	public function dashboard()
	{
		return view('dashboard');
	}

	public function detail($id)
	{
		$event = Event::findOrFail($id);

		$reservedPeople = ReservationService::getReservedPeople($event->id);

		if (!empty($reservedPeople)) {
			$reservablePeople = $event->max_people - $reservedPeople->number_of_people;
			$reservedPeople = $reservedPeople->number_of_people;
		} else {
			$reservablePeople = $event->max_people;
			$reservedPeople = 0;
		}

		$isReserved = Reservation::where('user_id', '=', Auth::id())
			->where('event_id', '=', $id)
			->where('canceled_date', '=', null)
			->latest()
			->first();

		return view('event-detail', compact(
			'event',
			'reservablePeople',
			'reservedPeople',
			'isReserved'
		));
	}

	public function reserve(Request $request)
	{
		$event = Event::findOrFail($request->id);

		$reservedPeople = ReservationService::getReservedPeople($event->id);

		if (
			empty($reservedPeople)
			|| $event->max_people >= $reservedPeople->number_of_people + $request->reserved_people
		) {
			Reservation::create([
				'user_id' => Auth::id(),
				'event_id' => $request->id,
				'number_of_people' => $request->reserved_people
			]);

			session()->flash('status', '予約しました。');
			return to_route('dashboard');
		} else {
			session()->flash('status', 'この人数は予約できません。');
			return view('dashboard');
		}
	}
}
