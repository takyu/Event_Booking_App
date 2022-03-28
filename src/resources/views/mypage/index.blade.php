<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      予約済みのイベント一覧
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
            <div class="mb-10 flex w-full flex-col text-center">
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
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($fromTodayEvents as $event)
                      <tr>
                        <td class="px-4 py-3 text-blue-500 hover:underline">
                          <a
                            href="{{ route('mypage.show', [
                                'id' => $event['id'],
                            ]) }}">
                            {{ $event['name'] }}
                          </a>
                        </td>
                        <td class="px-4 py-3">{{ $event['start_date'] }}</td>
                        <td class="px-4 py-3">{{ $event['end_date'] }}</td>
                        <td class="px-4 py-3">
                          {{ $event['number_of_people'] }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>

  <div class="py-8">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="overflow-auto whitespace-nowrap bg-white shadow-xl sm:rounded-lg">
        <h2 class="py-4 text-center">過去に予約したイベントの一覧</h2>
        <section class="body-font text-gray-600">
          <div class="container mx-auto px-4 py-8">
            @if (session('status'))
              <div class="m-10 mx-auto w-1/2 bg-blue-300 p-2 text-white">
                {{ session('status') }}
              </div>
            @endif
            <div class="mb-10 flex w-full flex-col text-center">
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
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pastEvents as $event)
                      <tr>
                        <td class="px-4 py-3 text-blue-500 hover:underline">
                          <a
                            href="{{ route('mypage.show', [
                                'id' => $event['id'],
                            ]) }}">
                            {{ $event['name'] }}
                          </a>
                        </td>
                        <td class="px-4 py-3">{{ $event['start_date'] }}</td>
                        <td class="px-4 py-3">{{ $event['end_date'] }}</td>
                        <td class="px-4 py-3">
                          {{ $event['number_of_people'] }}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>
