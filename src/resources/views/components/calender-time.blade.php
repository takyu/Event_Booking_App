<div>
  <div class="border border-gray-200 py-1 px-2 text-center">日</div>
  <div class="border border-gray-200 py-1 px-2 text-center">曜日</div>
  @for ($i = 10; $i < 20; $i++)
    <div class="h-8 border border-gray-200 py-1 px-2">
      {{ $i . ':00' }}
    </div>
    <div class="h-8 border border-gray-200 py-1 px-2">
      {{ $i . ':30' }}
    </div>
  @endfor
  <div class="h-8 border border-gray-200 py-1 px-2">
    20:00
  </div>
</div>
