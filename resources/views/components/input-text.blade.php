<div class="w-full">
    <div class="w-full mb-1 ml-1">
        <label for="{{ $id = $id ?? \Illuminate\Support\Str::uuid()->getHex() }}">
            {{ $placeholder }}
        </label>
    </div>
    <div class="w-full flex space-x-2">
        <div class="w-full">
            <input {{ $attributes->merge([
                'class' => 'w-full block rounded',
                'type' => 'text',
                'placeholder' => $placeholder,
                'name' => $name,
                'value' => $value,
                'id' => $id,
                ]) }} {{ $readonly ? 'readonly disabled' : '' }} />
        </div>
    </div>
</div>
