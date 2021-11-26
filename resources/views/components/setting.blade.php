@props(['heading'])
{{-- {{ dd($post1) }} --}}
<section class="max-w-4xl mx-auto py-8 ">
    <h1 class="text-lg font-bold mb-4 border-b pb-2 mb-6">{{ $heading }}</h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0 ">
            <ul class="space-y-4">
                <li class="font-semibold border-b pb-4">
                    Links
                </li>
                <li class="border-b pb-4 text-sm">
                    @admin
                    <a
                        href="/admin/posts"
                        class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}"
                    >
                        All Posts
                    </a>
                @else
                    <a
                        href="/{{ auth()->user()->username }}/posts"
                        class="{{ request()->is(auth()->user()->username . '/posts') ? 'text-blue-500' : '' }}"
                    >
                        All Posts
                    </a>
                    @endadmin
                </li>
                <li class="border-b pb-4 text-sm">
                    <a
                        href="/posts/{{ auth()->user()->username }}/create"
                        class="{{ request()->routeIs('postcreate') ? 'text-blue-500' : '' }}"
                    >
                        New Post
                    </a>
                </li>
                <li class="border-b pb-4 text-sm">
                    <a
                        href="/user/{{ auth()->user()->username }}/edit"
                        class="{{ request()->routeIs('edituser') ? 'text-blue-500' : '' }}"
                    >
                        Account
                    </a>
                </li>
                <li class="border-b pb-4 text-sm">
                    <a
                        href="/bookmark"
                        class="{{ request()->is('bookmark') ? 'text-blue-500' : '' }}"
                    >
                        Bookmarks
                    </a>
                </li>
            </ul>
        </aside>
        <main class="flex-1">

            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>

</section>
