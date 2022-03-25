<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

/**
 * Facades
 */

use Illuminate\Support\Facades\DB;

/**
 * Carbon
 */

use Carbon\Carbon;

/**
 * Models
 */

use App\Models\Event;

/**
 * Services
 */

use App\Services\EventService;

class EventController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$events = DB::table('events')
			->orderBy('start_date', 'asc')
			->paginate(10);

		return view('manager.events.index', compact('events'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('manager.events.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \App\Http\Requests\StoreEventRequest  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreEventRequest $request)
	{
		$check = EventService::checkEventDuplication(
			$request['event_date'],
			$request['start_time'],
			$request['end_time']
		);

		if ($check) {
			session()->flash('status', 'この時間帯は既に他の予約が存在しています。');
			return view('manager.events.create');
		}

		$startDate = EventService::joinDateAndTimeAndFormat(
			$request['event_date'],
			$request['start_time']
		);
		$endDate = EventService::joinDateAndTimeAndFormat(
			$request['event_date'],
			$request['end_time']
		);

		Event::create([
			'name' => $request['event_name'],
			'information' => $request['information'],
			'start_date' => $startDate,
			'end_date' => $endDate,
			'max_people' => $request['max_people'],
			'is_visible' => $request['is_visible']
		]);

		session()->flash('status', '登録しました。');
		return to_route('events.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function show(Event $event)
	{
		$event = Event::findOrFail($event->id);

		// Accessor
		$eventDate = $event->showEventDate;
		$startTime = $event->startTime;
		$endTime = $event->endTime;

		// dd($eventDate, $startTime, $endTime);

		return view('manager.events.show', compact(
			'event',
			'eventDate',
			'startTime',
			'endTime'
		));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Event $event)
	{
		$event = Event::findOrFail($event->id);

		// Accessor
		$eventDate = $event->editEventDate;
		$startTime = $event->startTime;
		$endTime = $event->endTime;

		return view('manager.events.edit', compact(
			'event',
			'eventDate',
			'startTime',
			'endTime'
		));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \App\Http\Requests\UpdateEventRequest  $request
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateEventRequest $request, Event $event)
	{
		$check = EventService::checkEventDuplicationExceptOwn(
			$event->id,
			$request['event_date'],
			$request['start_time'],
			$request['end_time']
		);

		if ($check) {

			$event = Event::findOrFail($event->id);

			// Accessor
			$eventDate = $event->editEventDate;
			$startTime = $event->startTime;
			$endTime = $event->endTime;

			session()->flash('status', 'この時間帯は既に他の予約が存在しています。');
			return view('manager.events.edit', compact(
				'event',
				'eventDate',
				'startTime',
				'endTime'
			));
		}

		$startDate = EventService::joinDateAndTimeAndFormat(
			$request['event_date'],
			$request['start_time']
		);
		$endDate = EventService::joinDateAndTimeAndFormat(
			$request['event_date'],
			$request['end_time']
		);

		$event = Event::findOrFail($event->id);


		$event->name = $request['event_name'];
		$event->information = $request['information'];
		$event->start_date = $startDate;
		$event->end_date = $endDate;
		$event->max_people = $request['max_people'];
		$event->is_visible = $request['is_visible'];

		$event->save();

		session()->flash('status', '更新しました。');
		return to_route('events.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Event  $event
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Event $event)
	{
		//
	}
}
