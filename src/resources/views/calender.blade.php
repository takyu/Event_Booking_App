<x-calender-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベントカレンダー
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="mx-auto sm:px-6 lg:px-8">
      <div class="overflow-auto bg-white shadow-xl sm:rounded-lg">
        @livewire('calender')
      </div>
    </div>
  </div>
</x-calender-layout>
