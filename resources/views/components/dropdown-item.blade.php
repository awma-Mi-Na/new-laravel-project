@props(['active' => false])

@php
$classes = 'block hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white text-left px-3 text-sm leading-6 my-1';

if ($active) {
    $classes .= ' bg-blue-500 text-white';
}
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
