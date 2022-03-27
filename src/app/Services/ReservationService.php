<?php

namespace App\Services;

/**
 * Facades
 */

use Illuminate\Support\Facades\DB;

class ReservationService
{
	public static function getReservedPeople($eventId)
	{
		return DB::table('reservations')
			->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
			->whereNull('canceled_date')
			->groupBy('event_id')
			->having('event_id', $eventId)
			->first();
	}
}
