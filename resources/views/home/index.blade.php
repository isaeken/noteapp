<x-app-layout>
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <div class="w-full px-1.5 mb-4">
                <div class="p-2 text-red-900 bg-red-400 border border-red-300 shadow rounded">
                    {{ $error }}
                </div>
            </div>
        @endforeach
    @endif

    <div class="flex w-full mb-4 px-1.5" x-data="{ open: false }">
        <div x-show="open == true" x-transition x-on:click="open = ! open" class="fixed bg-gray-800 bg-opacity-75 inset-0 z-40 cursor-default"></div>
        <div x-show="open == true" class="fixed bg-white w-full rounded shadow max-w-2xl left-1/2 top-1/2 cursor-default transform -translate-x-1/2 -translate-y-1/2 z-50">
            <x-note-form :note="null" />
        </div>

        <x-button class="cursor-pointer" x-on:click="open = ! open">{{ __('Write New Note') }}</x-button>
    </div>

    <div class="flex flex-wrap w-full">
        @foreach($notes as $item)
            <div class="w-1/3 p-1.5">
                <x-note-box :note="$item" />
            </div>
        @endforeach
    </div>
</x-app-layout>
