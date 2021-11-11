<div {{ $attributes->merge([
    'class' => $note->pinned ? 'bg-gray-100 text-black hover:bg-white cursor-pointer select-none transition border-2 border-indigo-300 rounded-lg' : 'bg-gray-100 text-black hover:bg-white cursor-pointer select-none transition border-2 rounded-lg',
]) }} x-data="{ open: false, page: '' }">
    <div x-show="open == true" x-transition x-on:click="open = ! open" class="fixed bg-gray-800 bg-opacity-75 inset-0 z-40 cursor-default"></div>
    <div x-show="open == true" class="fixed bg-white w-full rounded shadow max-w-2xl left-1/2 top-1/2 cursor-default transform -translate-x-1/2 -translate-y-1/2 z-50">
        <div x-show="page == 'edit'">
            <x-note-form :note="$note" />
        </div>
        <div x-show="page == 'delete'">
            <div class="p-4 space-y-2">
                <div class="text-3xl">{{ __('Are you sure?') }}</div>
                <div class="text-xl">
                    Are you sure to delete '<b>{{ $note->getTitleAttribute(false) }}</b>'?
                </div>
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="w-full flex">
                        <x-button class="ml-auto cursor-pointer" x-on:click="open = ! open">{{ __('Cancel') }}</x-button>
                        <x-form-button class="ml-2 cursor-pointer bg-red-300 text-red-900">{{ __('Delete') }}</x-form-button>
                    </div>
                </form>
            </div>
        </div>
        <div x-show="page == 'show'">
            <div class="p-4 pb-0 w-full flex items-center">
                <div class="w-full text-2xl font-serif font-semibold">
                    {{ $note->getTitleAttribute(false) }}
                </div>
                <div class="ml-auto">
                    <x-button class="px-2 cursor-pointer" x-on:click="open = ! open">
                        <svg class="w-5 h-5" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-labelledby="closeIconTitle" fill="none" stroke="currentColor"><title>Close</title><path d="M6.34314575 6.34314575L17.6568542 17.6568542M6.34314575 17.6568542L17.6568542 6.34314575"></path></svg>
                    </x-button>
                </div>
            </div>
            <div class="p-4 overflow-y-auto font-serif text-gray-600" style="max-height: 75vh;">
                {!! nl2br($note->getMessageAttribute(false)) !!}
            </div>
        </div>
    </div>

    <div class="py-3 px-4 rounded-lg relative" @if (mb_strlen($note->color)) style="color: {{ \Spatie\Color\Hex::fromString($note->color)->__toString() }}" @endif>
        <div class="relative block z-20">
            <div class="font-semibold flex">
                <div class="leading-8 w-full" x-on:click="open = ! open; page = 'show'">{{ $note->getTitleAttribute(false) }}</div>
                <div class="ml-auto flex space-x-2">
                    <a href="{{ route('notes.history', $note) }}" class="hover:bg-gray-200 transition flex items-center border bg-white w-8 h-8 text-black rounded">
                        <svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M11.998 2.5A9.503 9.503 0 003.378 8H5.75a.75.75 0 010 1.5H2a1 1 0 01-1-1V4.75a.75.75 0 011.5 0v1.697A10.997 10.997 0 0111.998 1C18.074 1 23 5.925 23 12s-4.926 11-11.002 11C6.014 23 1.146 18.223 1 12.275a.75.75 0 011.5-.037 9.5 9.5 0 009.498 9.262c5.248 0 9.502-4.253 9.502-9.5s-4.254-9.5-9.502-9.5z"></path><path d="M12.5 7.25a.75.75 0 00-1.5 0v5.5c0 .27.144.518.378.651l3.5 2a.75.75 0 00.744-1.302L12.5 12.315V7.25z"></path></svg>
                    </a>
                    <a href="#" x-on:click="open = ! open; page = 'edit';" class="hover:bg-gray-200 transition flex items-center border bg-white w-8 h-8 text-black rounded">
                        <svg class="w-5 h-5 mx-auto" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                    </a>
                    <a href="#" x-on:click="open = ! open; page = 'delete'" class="hover:bg-gray-200 bg-red-300 text-red-900 transition flex items-center border bg-white w-8 h-8 text-black rounded">
                        <svg class="w-5 h-5 mx-auto" width="24" height="24" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.03919 4.2939C3.01449 4.10866 3.0791 3.92338 3.23133 3.81499C3.9272 3.31953 6.3142 2 12 2C17.6858 2 20.0728 3.31952 20.7687 3.81499C20.9209 3.92338 20.9855 4.10866 20.9608 4.2939L19.2616 17.0378C19.0968 18.2744 18.3644 19.3632 17.2813 19.9821L16.9614 20.1649C13.8871 21.9217 10.1129 21.9217 7.03861 20.1649L6.71873 19.9821C5.6356 19.3632 4.90325 18.2744 4.73838 17.0378L3.03919 4.2939Z" stroke="currentColor" stroke-width="1.5"></path>
                            <path d="M3 5C5.57143 7.66666 18.4286 7.66662 21 5" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="py-3" x-on:click="open = ! open; page = 'show'">
                <p class="text-gray-600 h-20 overflow-hidden" @if (mb_strlen($note->color)) style="color: {{ \Spatie\Color\Hex::fromString($note->color)->__toString() }}" @endif>
                    {!! \Illuminate\Support\Str::limit(nl2br($note->getMessageAttribute(false))) !!}
                </p>
            </div>
        </div>
        <div class="absolute inset-0 z-10 rounded-lg" @if (mb_strlen($note->color)) style="background-color: {{ $note->color }};" @endif></div>
    </div>
</div>
