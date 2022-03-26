<div>
  カレンダー

  <input id="calender" class="mt-1 block w-full" type="text" name="calender" value="{{ $currentDate }}"
    wire:change="getDate($event.target.value)" />

  <div class="flex">
    @for ($i = 0; $i < 7; $i++)
      {{ $currentWeek[$i] }}
    @endfor
  </div>

  @foreach ($events as $event)
    <div>
      {{ $event->start_date }}
    </div>
  @endforeach
</div>
