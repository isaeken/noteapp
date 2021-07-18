<div class="w-full">
    <div class="w-full mb-1 ml-1">
        <label for="{{ $id }}">
            {{ $placeholder }}
        </label>
    </div>
    <div class="w-full flex space-x-2">
        <div class="w-full">
            <textarea {{ $attributes->merge([
                'rows' => '6',
                'class' => 'w-full block rounded',
                'placeholder' => $placeholder,
                'name' => $name,
                'id' => $id,
            ]) }} {{ $readonly ? 'readonly disabled' : '' }}>{{ $value }}</textarea>
        </div>
    </div>
</div>
