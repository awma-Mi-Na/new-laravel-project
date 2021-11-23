<x-layout>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <h1 class="font-semibold text-lg">Recently updated posts</h1>
            <ul>
                @foreach ($posts as $post)
                    <li>{{ $post->updated_at }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-center">No posts yet, please check again later.</p>
        @endif
    </main>
</x-layout>
