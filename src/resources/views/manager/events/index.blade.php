<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      イベント管理
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
        <section class="body-font text-gray-600">
          <div class="container mx-auto px-4 py-8">
            <div class="mb-20 flex w-full flex-col text-center">
              <div class="mx-auto w-full overflow-auto">
                <table class="whitespace-no-wrap mb-4 w-full table-auto text-left">
                  <thead>
                    <tr>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        イベント名</th>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        開始日時
                      </th>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        終了日時</th>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        予約人数
                      </th>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        定員
                      </th>
                      <th class="title-font bg-gray-100 px-4 py-3 text-sm font-medium tracking-wider text-gray-900">
                        表示・非表示
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($events as $event)
                      <tr>
                        <td class="px-4 py-3">{{ $event->name }}</td>
                        <td class="px-4 py-3">{{ $event->start_date }}</td>
                        <td class="px-4 py-3">{{ $event->end_date }}</td>
                        <td class="px-4 py-3">まだ</td>
                        <td class="px-4 py-3">{{ $event->max_people }}</td>
                        <td class="px-4 py-3">{{ $event->is_visible }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="my-6">
                  {{ $events->links() }}
                </div>
              </div>
              <div class="mx-auto mt-4 flex w-full pl-4 lg:w-2/3">
                <a class="inline-flex items-center text-green-500 md:mb-2 lg:mb-0">Learn More
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="ml-2 h-4 w-4" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                  </svg>
                </a>
                <button
                  class="ml-auto flex rounded border-0 bg-green-500 py-2 px-6 text-white hover:bg-green-600 focus:outline-none">Button</button>
              </div>
            </div>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>
