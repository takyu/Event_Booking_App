<?php

namespace App\Services;

/**
 * Carbon
 */

use Carbon\Carbon;

class MyPageService
{
	public static function reservedEvent($events, $during)
	{
		$reservedEvents = [];

		if ($during === \MyPageConst::FROM_TODAY) {
			foreach ($events->sortBy('start_date') as $event) {
				if (
					empty($event->pivot->canceled_date)
					&& $event->start_date >= Carbon::now()->format('Y-m-d H:i:s')
				) {
					$eventInfo = [
						'id' => $event->id,
						'name' => $event->name,
						'start_date' => $event->start_date,
						'end_date' => $event->end_date,
						'number_of_people' => $event->pivot->number_of_people
					];
					array_push($reservedEvents, $eventInfo);
				}
			}
		}

		if ($during === \MyPageConst::PAST) {
			foreach ($events->sortByDesc('start_date') as $event) {
				if (
					empty($event->pivot->canceled_date)
					&& $event->start_date < Carbon::now()->format('Y-m-d H:i:s')
				) {
					$eventInfo = [
						'id' => $event->id,
						'name' => $event->name,
						'start_date' => $event->start_date,
						'end_date' => $event->end_date,
						'number_of_people' => $event->pivot->number_of_people
					];
					array_push($reservedEvents, $eventInfo);
				}
			}
		}

		return $reservedEvents;
	}
}
