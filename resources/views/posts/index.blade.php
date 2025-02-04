<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          学習の記録一覧
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 text-gray-900">

                  {{-- 一覧表示 --}}
                  <div class="overflow-x-auto lg:w-2/3 w-full mx-auto overflow-auto">
                    <table class="whitespace-nowrap table-auto w-full text-left whitespace-no-wrap">
                      <thead>
                        <tr>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">詳細</th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学習日</th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">学習時間</th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">状態</th>
                          <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">コメント</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($posts as $post)
                        <tr>
                          <td class="border-t-2 border-gray-200 px-4 py-3">
                            <a class="text-blue-500" href="{{ route('posts.show', ['post' => $post->id]) }}">詳細</a>
                          </td>
                          <td class="border-t-2 border-gray-200 px-4 py-3">{{ $post->date }}</td>
                          <td class="border-t-2 border-gray-200 px-4 py-3">{{ $post->hours }}時間{{ $post->minutes }}分</td>
                          <td class="border-t-2 border-gray-200 px-4 py-3">{{ $post->status_label }}</td>
                          {{-- <td class="border-t-2 border-gray-200 px-4 py-3">{{ $status }}</td> --}}
                          <td class="border-t-2 border-gray-200 px-4 py-3">{{ $post->comment }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  {{ $posts->links() }}
              </div>
          </div>
      </div>
  </div>
  <!-- フローティングボタン -->
  <a href="{{ route('posts.create') }}"
      class="sm:hidden fixed z-50 bottom-4 right-4 w-12 h-12 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-blue-700">
      <!-- アイコン（プラス記号） -->
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
  </a>
</x-app-layout>