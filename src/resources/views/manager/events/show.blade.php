<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベント詳細内容
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

        <div class="mx-auto max-w-2xl py-8">
          <x-jet-validation-errors class="mb-4" />

          @if (session('status'))
            <div class="m-10 mx-auto w-1/2 bg-blue-300 p-2 text-white">
              {{ session('status') }}
            </div>
          @endif

          <form method="get" action="{{ route('events.edit', [
              'event' => $event->id,
          ]) }}">

            <div class="text-center md:text-left">
              <x-jet-label for="event_name" value="イベント名" />
              {{ $event->name }}
            </div>

            <div class="mt-4 text-center md:text-left">
              <x-jet-label for="information" value="イベント情報" />

              {{-- how to write to recognize line breaks --}}
              {!! nl2br(e($event->information)) !!}
            </div>

            <div class="justify-between md:flex">
              <div class="mt-4 text-center md:text-left">
                <x-jet-label for="event_date" value="イベントの日付" />
                {{ $eventDate }}
              </div>

              <div class="mt-4 text-center md:text-left">
                <x-jet-label for="start_time" value="開始時刻" />
                {{ $event->startTime }}
              </div>

              <div class="mt-4 text-center md:text-left">
                <x-jet-label for="end_time" value="終了時刻" />
                {{ $event->endTime }}
              </div>
            </div>

            <div class="items-end justify-between md:flex">
              <div class="mt-4 text-center md:text-left">
                <x-jet-label for="max_people" value="定員数" />
                {{ $event->max_people }}
              </div>

              <div class="mt-6 flex items-center justify-around space-x-8 md:mt-0">
                @if ($event->is_visible)
                  表示中
                @else
                  非表示中
                @endif
              </div>


              <div class="mt-8 text-center md:text-left">
                <x-jet-button>
                  編集する
                </x-jet-button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
