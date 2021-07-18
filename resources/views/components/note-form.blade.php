<form action="{{ $action }}" method="POST">
    @csrf
    @method($method)
    @if (! $create)
        <input type="hidden" name="note_id" value="{{ $note->id }}">
    @endif
    <div>
        <label class="w-full block">
            <span class="hidden">Title</span>
            <input {{ $create ? 'autofocus' : '' }} class="border-none text-lg w-full rounded-t font-semibold" type="text" name="title" placeholder="Title" value="{{ $create ? '' : $note->getTitleAttribute(false) }}" required>
        </label>
    </div>
    <div class="py-2 px-3 space-y-3">
        <x-checkbox :checked="$create ? false : $note->pinned" name="pinned" :placeholder="__('Pinned')" />
        <x-input-text :value="$create ? null : $note->order" name="order" type="number" step="1" :placeholder="__('Order')" />
        <x-color-picker :value="$create ? null : $note->color" name="color" />
        <x-textarea name="message" :placeholder="__('Message')" :value="$create ? '' : $note->getMessageAttribute(false)" required />
        <div class="flex w-full mt-2">
            <x-button x-on:click="open = false" class="ml-auto cursor-pointer">{{ __('Cancel') }}</x-button>
            <x-form-button class="ml-2">{{ __('Save') }}</x-form-button>
        </div>
    </div>
</form>
