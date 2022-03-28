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

          <form id="cancel_{{ $event->id }}" method="post"
            action="{{ route('mypage.cancel', [
                'id' => $event->id,
            ]) }}">
            @csrf

            <div class="items-end justify-between md:flex">

              <div class="mt-4 text-center">
                <x-jet-label for="max_people" value="予約人数" />
                {{ $reservation->number_of_people }}
              </div>

              @if ($event->dayBeforeEventDate >= \Carbon\Carbon::today()->format('Y年m月d日'))
                <div class="mt-8 text-center md:text-left">
                  <a href="#" data-id="{{ $event->id }}" onclick="cancelPost(this)"
                    class="inline-flex items-center rounded-md border border-transparent bg-red-500 px-4 py-2 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-red-600 focus:border-red-900 focus:outline-none focus:ring focus:ring-red-300 active:bg-red-900 disabled:opacity-25">
                    キャンセルする
                  </a>
                </div>
              @elseif ($event->showEventDate <= \Carbon\Carbon::today()->format('Y年m月d日'))
                <div class="mt-6 flex flex-col text-center md:mt-0">
                  <span class="mb-2 text-xl text-green-500">ご参加ありがとうございました。</span>
                </div>
              @endif

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function cancelPost(e) {
      'use strict';
      if (confirm('本当にキャンセルしてもいいですか?')) {
        document.querySelector('#cancel_' + e.dataset.id).submit();
      }
    }
  </script>
</x-app-layout>
