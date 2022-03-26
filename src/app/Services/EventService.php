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

	public static function getWeekEvents($startDate, $endDate)
	{
		$reservedPeople = DB::table('reservations')
			->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
			->whereNull('canceled_date')
			->groupBy('event_id');

		return DB::table('events')
			->leftJoinSub(
				$reservedPeople,
				'reserved_people',
				fn ($join) => $join->on('events.id', '=', 'reserved_people.event_id')
			)
			->whereBetween('start_date', [$startDate, $endDate])
			->whereNull('deleted_at')
			->orderBy('start_date', 'asc')
			->get();
	}
}
