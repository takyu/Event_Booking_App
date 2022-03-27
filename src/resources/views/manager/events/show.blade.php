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

          <form method="get" action="{{ route('events.edit', [
              'event' => $event->id,
          ]) }}">

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
                {{ $numberOfReservedPeople }} / {{ $event->max_people }}
              </div>

              <div class="mt-6 flex items-center justify-around space-x-8 md:mt-0">
                @if ($event->is_visible)
                  <div class="text-md block text-center font-medium text-blue-700">
                    表示中
                  </div>
                @else
                  <div class="text-md block text-center font-medium text-red-700">
                    非表示中
                  </div>
                @endif
              </div>
              @if ($eventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                <div class="mt-8 text-center md:text-left">
                  <x-jet-button>
                    編集
                  </x-jet-button>
                </div>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <div class="mx-auto max-w-2xl py-8">
          @if (!$users->isEmpty())
            <div class="mb-5 block text-center text-lg font-medium text-gray-700">
              予約情報
            </div>
            <table class="whitespace-no-wrap mb-4 w-full table-auto text-left">
              <thead>
                <tr>
                  <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                    予約者名</th>
                  <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                    予約人数
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($reservations as $reservation)
                  @if (is_null($reservation['canceled_date']))
                    <tr>
                      <td class="px-4 py-3">
                        {{ $reservation['name'] }}
                      </td>
                      <td class="px-4 py-3">
                        {{ $reservation['number_of_people'] }}
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          @else
            <div class="text-center">
              予約者情報はありません。
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
      <div class="mx-auto max-w-2xl py-8">
        <div class="text-center">
          <form method="POST" id="delete_{{ $event->id }}"
            action="{{ route('events.destroy', [
                'event' => $event->id,
            ]) }}">
            @csrf
            @method('delete')
            <a href="#" data-id="{{ $event->id }}" onclick="deletePost(this)"
              class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-red-600 focus:border-red-900 focus:outline-none focus:ring focus:ring-red-300 active:bg-red-900 disabled:opacity-25">
              削除する
            </a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ mix('js/flatpickr.js') }}"></script>
  <script>
    function deletePost(e) {
      'use strict';
      if (confirm('本当に削除してもいいですか?')) {
        document.querySelector('#delete_' + e.dataset.id).submit();
      }
    }
  </script>
</x-app-layout>
