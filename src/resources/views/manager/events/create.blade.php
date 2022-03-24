<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベント新規登録
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        日付<input type="text" name="event_date" id="event_date">
        開始時刻<input type="text" name="start_time" id="start_time">
        終了時刻<input type="text" name="end_time" id="end_time">
      </div>
    </div>
  </div>
  <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
