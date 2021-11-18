@props(['field'])
<x-form.field>

    <x-form.label field="{{ $field }}" />

    <input
        class="border border-gray-200 p-2 w-full"
        name="{{ $field }}"
        id="{{ $field }}"
        required
        {{ $attributes(['value' => old($field)]) }}
    >
</x-form.field>
<x-form.error field=" {{ $field }} " />
