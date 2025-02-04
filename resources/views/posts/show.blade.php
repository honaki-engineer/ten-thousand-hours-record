<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{-- {{ __('Dashboard') }} --}}
          詳細画面
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">

            {{-- tailblocks詳細 --}}
            <section class="text-gray-600 body-font relative">
                    <div class="container px-5 mx-auto">
                    <div class="lg:w-1/2 md:w-2/3 mx-auto">
                        <div class="flex flex-wrap -m-2">
                        <div class="p-2 w-full">
                            <div class="relative">
                            <label for="date" class="leading-7 text-sm text-gray-600">学習日</label>
                            <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $post->date }}</div>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="name" class="leading-7 text-sm text-gray-600">学習時間</label>
                                <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $post->hours }}時間{{ $post->minutes }}分</div>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                                <label for="status" class="leading-7 text-sm text-gray-600">状態</label>
                                <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ $post->status_label }}</div>
                            </div>
                        </div>
                        <div class="p-2 w-full">
                            <div class="relative">
                            <label for="comment" class="leading-7 text-sm text-gray-600">コメント</label>
                            @if($post->comment)
                            <div class="w-full rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ $post->comment }}</div>
                            @endif
                            </div>
                        </div>

                        {{-- editへ遷移するボタン --}}
                        <form method="get" action="{{ route('posts.edit', ['post' => $post->id]) }}">
                            <div class="p-2 w-full">
                                <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">修正する</button>
                            </div>
                        </form>
                        {{-- 削除ボタン --}}
                        <form id="delete_{{ $post->id }}" method="post" action="{{ route('posts.destroy', ['post' => $post->id]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="p-2 w-full">
                                <a href="#" data-id="{{ $post->id }}" onclick="deletePost(this)" 
                                    class="flex mx-auto text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-lg">削除する</a>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>
            </section>
            </div>
          </div>
      </div>
  </div>
<!-- 確認メッセージ -->
<script>
function deletePost(e){
    'use strict'
    if(confirm('本当に削除していいですか？')){
        document.getElementById('delete_' + e.dataset.id).submit()
    }
}
</script>
</x-app-layout>