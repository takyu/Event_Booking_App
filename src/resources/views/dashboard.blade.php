<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベントカレンダー
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-auto bg-white shadow-xl sm:rounded-lg">
        @if (session('status'))
          <div class="m-10 mx-auto w-1/2 bg-blue-300 p-2 text-center text-white">
            {{ session('status') }}
          </div>
        @endif
        @livewire('calender')
      </div>
    </div>
  </div>
  <script src="{{ mix('js/flatpickr.js') }}"></script>
</x-app-layout>
