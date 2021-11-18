@props(['field', 'rows' => null])

<x-form.field>
    <x-form.label field="{{ $field }}" />
    <textarea
        class="border border-gray-200 p-2 w-full"
        type="text"
        name="{{ $field }}"
        id="{{ $field }}"
        rows="{{ $rows }}"
    >{{ $slot ?? old($field) }}</textarea>
</x-form.field>

<x-form.error field="{{ $field }}" />
