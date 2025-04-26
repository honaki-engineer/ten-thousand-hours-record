<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            学習記録フォーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- tailblocksのフォーム --}}
                    <section class="text-gray-600 body-font relative">
                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                    <div class="flex flex-wrap -m-2">

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="date"
                                                    class="leading-7 text-sm text-gray-600">学習日</label>
                                                <input type="date" id="date" name="date"
                                                    value="{{ old('date') }}"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="p-2 w-1/2">
                                            <label for="hours" class="leading-7 text-sm text-gray-600">学習時間</label>
                                            <div class="grid grid-cols-[1fr_auto] items-center gap-2">
                                                <select id="hours" name="hours"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @for ($hours = 0; $hours <= 23; $hours++)
                                                        <option value="{{ $hours }}"
                                                            {{ old('hours') == $hours ? 'selected' : '' }}>
                                                            {{ $hours }}</option>
                                                    @endfor
                                                </select>
                                                <p class="text-sm text-gray-600">時間</p>
                                                <select id="minutes" name="minutes"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    @for ($minutes = 0; $minutes <= 59; $minutes++)
                                                        <option value="{{ $minutes }}"
                                                            {{ old('minutes') == $minutes ? 'selected' : '' }}>
                                                            {{ $minutes }}</option>
                                                    @endfor
                                                </select>
                                                <p class="text-sm text-gray-600">分</p>
                                                <x-input-error :messages="$errors->get('hours')" class="mt-2" />
                                                <x-input-error :messages="$errors->get('minutes')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="status" class="leading-7 text-sm text-gray-600">状態</label>
                                                <select name="status" id="status"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                                    <option value="">選択してください</option>
                                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>仕事
                                                    </option>
                                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>休み
                                                    </option>
                                                    <option value="3" {{ old('status') == 3 ? 'selected' : '' }}>
                                                        その他</option>
                                                </select>
                                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="p-2 w-full">
                                            <div class="relative">
                                                <label for="comment"
                                                    class="leading-7 text-sm text-gray-600">コメント</label>
                                                <textarea id="comment" name="comment"
                                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ old('comment') }}</textarea>
                                                <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="p-2 w-full">
                                            <button
                                                class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">記録する</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>

                </div>
            </div>
        </div>
    </div>

    {{-- 日付クリック有効範囲を全域にする --}}
    <script>
        document.getElementById("date").addEventListener("click", function() {
            this.showPicker(); // Chrome でカレンダーを開く
        });
    </script>

</x-app-layout>
