@props(['color' => 'bg-blue-500'])

@php
$classes = 'text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-blue-600 ';
$classes .= $color;
@endphp
<x-form.field>

    <button
        type="submit"
        {{ $attributes->merge(['class' => $classes]) }}
    >
        {{ $slot }}
    </button>
</x-form.field>
