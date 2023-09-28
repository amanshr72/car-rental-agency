<label {{ $attributes->merge([
    'class' => 'block text-md font-medium text-gray-700',
]) }}>
    {{ $slot }}
</label>
