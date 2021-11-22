@props(['heading'])

<section class="max-w-4xl mx-auto py-8 ">
    <h1 class="text-lg font-bold mb-4 border-b pb-2 mb-6">{{ $heading }}</h1>
    <div class="flex">
        <aside class="w-48 flex-shrink-0 ">
            <ul class="space-y-4">
                <li class="font-semibold border-b pb-4">
                    Links
                </li>
                <li class="border-b pb-4 text-sm">
                    <a
                        href="/admin/posts"
                        class="{{ request()->routeIs('allposts') ? 'text-blue-500' : '' }}"
                    >
                        All Posts
                    </a>
                </li>
                <li class="border-b pb-4 text-sm">
                    <a
                        href="/admin/posts/create"
                        class="{{ request()->routeIs('newpost') ? 'text-blue-500' : '' }}"
                    >
                        New Post
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
