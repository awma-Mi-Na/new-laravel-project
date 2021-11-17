<div x-data="{show: false}" @click.away="show = false">
    {{-- Trigger --}}

    <div @click="show = !show">
        {{ $trigger }}

    </div>

    {{-- dropdown items(links) --}}
    {{ $slot }}
</div>
