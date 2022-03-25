<?php

namespace App\Services;

/**
 * Facades
 */

use Illuminate\Support\Facades\DB;

/**
 * Carbon
 */

use Carbon\Carbon;

class EventService
{
	public static function checkEventDuplication($eventDate, $startTime, $endTime)
	{
		return DB::table('events')
			->whereDate('start_date', $eventDate)
			->whereTime('end_date', '>', $startTime)
			->whereTime('start_date', '<', $endTime)
			->exists();
	}

	public static function checkEventDuplicationExceptOwn($ownEventId, $eventDate, $startTime, $endTime)
	{
		$event = DB::table('events')
			->whereDate('start_date', $eventDate)
			->whereTime('end_date', '>', $startTime)
			->whereTime('start_date', '<', $endTime)
			->get()
			->toArray();

		if (empty($event)) {
			return false;
		}

		$eventId = $event[0]->id;

		if ($ownEventId === $eventId) {
			return false;
		} else {
			return true;
		}
	}

	public static function joinDateAndTimeAndFormat($date, $time)
	{
		$concatDate = $date . ' ' . $time;

		return Carbon::createFromFormat(
			'Y-m-d H:i',
			$concatDate
		);
	}
}
