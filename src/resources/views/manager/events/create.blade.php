<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベント新規登録
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

        <div class="mx-auto max-w-2xl py-8">
          <x-jet-validation-errors class="mb-4" />

          @if (session('status'))
            <div class="mb-4 text-sm font-medium text-green-600">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('events.store') }}">
            @csrf

            <div>
              <x-jet-label for="event_name" value="イベント名" />
              <x-jet-input id="event_name" class="mt-1 block w-full" type="text" name="event_name"
                :value="old('event_name')" required autofocus />
            </div>

            <div class="mt-4">
              <x-jet-label for="information" value="イベント情報" />
              <x-textarea row="3" id="information" name="information" class="mt-1 block w-full">
                {{ old('information') }}</x-textarea>
            </div>

            <div class="justify-between md:flex">
              <div class="mt-4">
                <x-jet-label for="event_date" value="イベントの日付" />
                <x-jet-input id="event_date" class="mt-1 block w-full" type="text" name="event_date" required />
              </div>

              <div class="mt-4">
                <x-jet-label for="start_time" value="開始時刻" />
                <x-jet-input id="start_time" class="mt-1 block w-full" type="text" name="start_time" required />
              </div>

              <div class="mt-4">
                <x-jet-label for="end_time" value="終了時刻" />
                <x-jet-input id="end_time" class="mt-1 block w-full" type="text" name="end_time" required />
              </div>
            </div>

            <div class="items-end justify-between md:flex">
              <div class="mt-4">
                <x-jet-label for="max_people" value="定員数" />
                <x-jet-input id="max_people" class="mt-1 block w-full" type="number" name="max_people" required />
              </div>

              <div class="mt-6 flex items-center justify-around space-x-8 md:mt-0">
                <input type="radio" name="is_visible" value="1" checked class="mr-2" />表示
                <input type="radio" name="is_visible" value="0" checked class="mr-2" />非表示
              </div>


              <div class="mt-8 text-center">
                <x-jet-button>
                  新規登録
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
