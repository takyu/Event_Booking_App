<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      過去のイベントの一覧
    </h2>
  </x-slot>

  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-auto whitespace-nowrap bg-white shadow-xl sm:rounded-lg">
        <section class="body-font text-gray-600">
          <div class="container mx-auto px-4 py-8">
            @if (session('status'))
              <div class="m-10 mx-auto w-1/2 bg-blue-300 p-2 text-white">
                {{ session('status') }}
              </div>
            @endif
            <div class="mb-8 justify-between text-center md:flex">
              <div class="mb-6 md:mb-0">
                <button onclick="location.href='{{ route('events.deleted') }}'"
                  class="inline-flex items-center rounded-md border border-transparent bg-gray-500 px-4 py-2 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-gray-600 focus:border-gray-900 focus:outline-none focus:ring focus:ring-gray-300 active:bg-gray-900 disabled:opacity-25">
                  削除済みイベント一覧
                </button>
              </div>
              <div class="mb-6 md:mb-0">
                <button onclick="location.href='{{ route('events.index') }}'"
                  class="inline-flex items-center rounded-md border border-transparent bg-blue-500 px-4 py-2 text-sm font-semibold uppercase tracking-widest text-white transition hover:bg-blue-600 focus:border-blue-900 focus:outline-none focus:ring focus:ring-blue-300 active:bg-blue-900 disabled:opacity-25">
                  現在のイベント一覧 </button>
              </div>
            </div>
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
                        表示
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($events as $event)
                      <tr>
                        <td class="px-4 py-3 text-blue-500 hover:underline">
                          <a
                            href="{{ route('events.show', [
                                'event' => $event->id,
                            ]) }}">
                            {{ $event->name }}
                          </a>
                        </td>
                        <td class="px-4 py-3">{{ $event->start_date }}</td>
                        <td class="px-4 py-3">{{ $event->end_date }}</td>
                        <td class="px-4 py-3">
                          @if (is_null($event->number_of_people))
                            0
                          @else
                            {{ $event->number_of_people }}
                          @endif
                        </td>
                        <td class="px-4 py-3">{{ $event->max_people }}</td>
                        <td class="px-4 py-3">
                          @if ($event->is_visible)
                            表示
                          @else
                            非表示
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="my-6">
                  {{ $events->links() }}
                </div>
              </div>
              <div class="mx-auto mt-4 flex w-full pl-4 lg:w-2/3">

              </div>
            </div>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>
