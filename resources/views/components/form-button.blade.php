<button {{ $attributes->merge([
    'class' => 'bg-gray-200 hover:bg-gray-300 text-indigo-900 text-center font-semibold inline-block py-2 px-3 transition rounded'
]) }}>
    {{ $slot }}
</button>
