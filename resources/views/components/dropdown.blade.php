<div
    x-data="{show: false}"
    @click.away="show = false"
    class="relative"
>
    {{-- Trigger --}}

    <div @click="show = !show">
        {{ $trigger }}

    </div>

    {{-- dropdown items(links) --}}
    <div
        x-show="show"
        class="py-2 absolute bg-gray-100 w-full z-50 max-h-52 overflow-auto "
        style="display: none"
    >
        {{ $slot }}
    </div>
</div>
