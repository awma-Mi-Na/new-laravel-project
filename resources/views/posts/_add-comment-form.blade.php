@auth

    <x-panel>
        <form
            action="/comment/{{ $post->slug }}"
            method="post"
        >
            @csrf
            <header class="flex items-center">
                <x-avatar :photo="auth()->user()->avatar" />
                <h2 class="ml-4">Want to participate?</h2>
            </header>
            <div class="mt-6">
                <textarea
                    name="body"
                    class="w-full text-sm focus:outline-none focus:ring"
                    rows="5"
                    placeholder="Quick, think of something to say!"
                    required
                ></textarea>

                @error('body')
                    <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end mt-6 pt-6 border-t border-gray-200 gap-2">
                <x-form.button>Post</x-form.button>
            </div>
        </form>
    </x-panel>
@else
    <p>
        <a
            href="/register"
            class="hover:underline text-blue-500 hover:text-blue-600"
        >Register</a> or <a
            href="/login"
            class="hover:underline text-blue-500 hover:text-blue-600"
        >log in</a> to leave a comment.
    </p>
@endauth
