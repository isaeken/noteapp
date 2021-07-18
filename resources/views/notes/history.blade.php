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

    <div class="space-y-4">
        @foreach($versions as $version)
            <div class="bg-white border shadow-sm rounded space-y-3">
                <div class="{{ in_array('title', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">Title</div>
                    <div class="w-full">{{ $version->getTitleAttribute(false) }}</div>
                </div>
                <div class="{{ in_array('user_id', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">User</div>
                    <div class="w-full"><a href="#">{{ $version->user->name }}</a></div>
                </div>
                <div class="{{ in_array('pinned', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">Is Pinned</div>
                    <div class="w-full">{{ $version->pinned ? 'Yes' : 'No' }}</div>
                </div>
                <div class="{{ in_array('order', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">Order</div>
                    <div class="w-full">{{ $version->order }}</div>
                </div>
                <div class="{{ in_array('color', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">Color</div>
                    <div class="w-full">{{ $version->color }}</div>
                </div>
                <div class="{{ in_array('message', $version->differences) ? 'w-full p-3 border-b' : 'w-full p-3 border-b opacity-50 hover:opacity-100' }}">
                    <div class="w-full text-sm text-gray-700 font-semibold">Content</div>
                    <div class="w-full">
                        <p>{!! nl2br($version->getMessageAttribute(false)) !!}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
