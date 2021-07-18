<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="w-full flex mx-1">
        <div class="w-auto">
            <input class="rounded" {{ $readonly ? 'readonly disabled' : '' }} type="checkbox" placeholder="{{ $placeholder }}" name="{{ $name }}" {{ $checked ? 'checked="true"' : '' }} value="true" id="{{ $id }}">
        </div>
        <div class="w-full px-2 py-0.5">
            <label class="" for="{{ $id }}">
                {{ $placeholder }}
            </label>
        </div>
    </div>

{{--    <div class="w-full mb-1 ml-1">--}}
{{--        <label for="{{ $id = $id ?? \Illuminate\Support\Str::uuid()->getHex() }}">--}}
{{--            {{ $placeholder }}--}}
{{--        </label>--}}
{{--    </div>--}}
{{--    <div class="w-full flex space-x-2">--}}
{{--        <div class="w-full">--}}
{{--            <input class="w-full block rounded" {{ $readonly ? 'readonly disabled' : '' }} type="text" placeholder="{{ $placeholder }}" name="{{ $name }}" value="{{ $value }}" id="{{ $id }}">--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
