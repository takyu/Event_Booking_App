<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent
 */

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Carbon
 */

use Carbon\Carbon;

class Event extends Model
{
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var string[]
	 */
	protected $fillable = [
		'name',
		'information',
		'max_people',
		'start_date',
		'end_date',
		'is_visible'
	];

	/**
	 * Get the event's date.
	 * To use show controller.
	 *
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	protected function showEventDate(): Attribute
	{
		return new Attribute(
			get: fn () => Carbon::parse($this->start_date)->format('Y年m月d日')
		);
	}

	/**
	 * Get the event's date.
	 * To use edit controller.
	 *
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	protected function editEventDate(): Attribute
	{
		return new Attribute(
			get: fn () => Carbon::parse($this->start_date)->format('Y-m-d')
		);
	}

	/**
	 * Get the event's start time.
	 *
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	protected function startTime(): Attribute
	{
		return new Attribute(
			get: fn () => Carbon::parse($this->start_date)->format('H時i分')
		);
	}

	/**
	 * Get the event's end time.
	 *
	 * @return \Illuminate\Database\Eloquent\Casts\Attribute
	 */
	protected function endTime(): Attribute
	{
		return new Attribute(
			get: fn () => Carbon::parse($this->end_date)->format('H時i分')
		);
	}
}
