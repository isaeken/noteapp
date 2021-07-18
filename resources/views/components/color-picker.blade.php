<div class="w-full" x-data="{ color: '{{ $value ?? '' }}' }">
    <div class="w-full mb-1 ml-1 flex">
        <label for="{{ $id }}">
            {{ $placeholder }}
        </label>
        <div class="mt-1.5 mx-1.5 w-3.5 h-3.5 inline rounded border" x-bind:style="`background-color: ${color};`"></div>
        <input {{ $attributes->merge([
            'type' => 'hidden',
            'id' => $id,
            'name' => $name,
            ':value' => 'color',
        ]) }}>
    </div>
    <div class="w-full flex">
        @foreach($colors as $color)
            <div class="p-4 border-2 rounded cursor-pointer"
                 style="background-color: {{ $color }};"
                 x-bind:class="{ 'border-blue-500' : color == '{{ $color }}' }"
                 x-on:click="document.getElementById('{{ $id }}').value = color = '{{ $color }}';"></div>
        @endforeach

        <input type="color" id="{{ $id_picker = $id . '_picker' }}" class="hidden" x-on:change="color = document.getElementById('{{ $id_picker }}').value;">
        <div class="bg-white p-4 border-2 rounded cursor-pointer bg-gradient-to-r from-green-400 to-blue-500"
             x-bind:class="{ 'border-blue-500' : !'{{ implode(',', $colors) }}'.includes(color) }"
             x-on:click="let picker = document.getElementById('{{ $id_picker }}'); picker.focus(); picker.click();"></div>
    </div>
</div>
