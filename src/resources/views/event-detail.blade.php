<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベント詳細内容
    </h2>
  </x-slot>

  <div class="pt-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

        <div class="mx-auto max-w-2xl py-8">
          <x-jet-validation-errors class="mb-4" />

          @if (session('status'))
            <div class="m-10 mx-auto w-1/2 bg-blue-300 p-2 text-white">
              {{ session('status') }}
            </div>
          @endif

          <form method="post" action="{{ route('events.reserve', [
              'id' => $event->id,
          ]) }}">
            @csrf

            <div class="text-center md:text-left">
              <x-jet-label for="event_name" value="イベント名" />
              {{ $event->name }}
            </div>

            <div class="mt-4 px-4 text-center md:px-0 md:text-left">
              <x-jet-label for="information" value="イベント情報" />

              {{-- how to write to recognize line breaks --}}
              {!! nl2br(e($event->information)) !!}
            </div>

            <div class="justify-between md:flex">
              <div class="mt-4 text-center">
                <x-jet-label for="event_date" value="イベントの日付" />
                {{ $event->showEventDate }}
              </div>

              <div class="mt-4 text-center">
                <x-jet-label for="start_time" value="開始時刻" />
                {{ $event->startTime }}
              </div>

              <div class="mt-4 text-center">
                <x-jet-label for="end_time" value="終了時刻" />
                {{ $event->endTime }}
              </div>
            </div>

            <div class="items-end justify-between md:flex">
              <div class="mt-4 text-center">
                <x-jet-label for="max_people" value="予約人数 / 定員数" />
                {{ $reservedPeople }} / {{ $event->max_people }}
              </div>

              <div class="mt-4 items-center text-center">
                @if ($reservablePeople <= 0)
                  <span class="text-sm text-rose-400">定員に達しました。</span>
                @else
                  <x-jet-label class="md:mb-2" for="reserved_people" value="予約人数" />
                  <select name="reserved_people" id="">
                    @for ($i = 1; $i <= $reservablePeople; $i++)
                      <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                  </select>
                @endif
              </div>
              <input type="hidden" name="id" value="{{ $event->id }}">
              @if ($reservablePeople <= 0)
                <div class="mt-8 text-center md:text-left">
                  <x-jet-button disabled>
                    予約する
                  </x-jet-button>
                </div>
              @else
                <div class="mt-8 text-center md:text-left">
                  <x-jet-button>
                    予約する
                  </x-jet-button>
                </div>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
