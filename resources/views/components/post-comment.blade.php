@props(['comment', 'currentUser'])
<x-panel class="bg-gray-50">
    <article class="flex space-x-4">
        <div class="flex-shrink-0">
            <x-avatar :photo="$comment->author->avatar" />
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->name }}</h3>

                <p class="text-xs">
                    Posted
                    <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
            @if (auth()->user()->username === $comment->author->username)

                <button
                    class="bg-blue-500 font-semibold hover:bg-blue-600 mt-4 px-2 py-1 rounded-2xl text-white text-xs"><a
                        href="/comment/{{ $comment->id }}/edit"
                    >Edit</a></button>
            @endif
        </div>
    </article>
</x-panel>
