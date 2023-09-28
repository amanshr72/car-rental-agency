@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        ' border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-300 block w-full p-2.5',
]) !!}>
