<x-dropdown>

    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">

            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}


            <x-icon
                name="down-arrow"
                class="absolute pointer-events-none"
                style="right: 12px;"
            />

        </button>

    </x-slot>

    <div
        x-show="show"
        class="py-2 absolute bg-gray-100 w-full z-50 h-52 overflow-auto"
        style="display: none"
    >

        {{-- <x-dropdown-item href="/" :active="request()->routeIs('home')">All</x-dropdown-item> --}}
        <x-dropdown-item
            href="/?{{ http_build_query(request()->except('category', 'page')) }}"
            :active="request('category')===NULL"
        >All</x-dropdown-item>

        @foreach ($categories as $category)

            {{-- <x-dropdown-item href="/categories/{{ $category->slug }}" --}}
            {{-- :active="isset($currentCategory) && $currentCategory->is($category)"> --}}

            <x-dropdown-item
                href="/?category={{ $category->slug }} & {{ http_build_query(request()->except('category', 'page')) }}"
                :active="request('category')===($category->slug)"
            >
                {{ ucwords($category->name) }}
            </x-dropdown-item>
        @endforeach

    </div>
</x-dropdown>