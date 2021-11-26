@props(['field'])
<x-form.field>

    <x-form.label field="{{ $field }}" />

    <input
        name="{{ $field }}"
        id="{{ $field }}"
        {{ $attributes(['value' => old($field), 'class' => 'border border-gray-200 p-2 w-full']) }}
    >
    <x-form.error field="{{ $field }}" />
</x-form.field>
