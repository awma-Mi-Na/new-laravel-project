@php
// $followers = $post->author->followers->where('follower_id', auth()->user()->id)->toArray();
// $followers = array_column($followers, 'user_id');
// dd(in_array($post->author->id, $followers));

// foreach ($followers as $follower) {
//     logger($follower['follower_id']);
// }
// dd($followers->follower_id);
// $followers = array_filter($followers, function ($follower) {
//     return $follower['follower_id'] == 2;
// });

// $following = array_column($followers, 'user_id');

// want: to select the user_id from followers table where the followers_id is equal to the logged in user
// dd(auth()->user()->id . ' is following => ', $following);

dd($post->author->followers->contains(function($value,'follower_id'){
    return;

}));
@endphp

<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center mb-10">
                    <div class="mb-8 text-left text-sm">
                        {{-- <a href="{!! route('createBookmark', ['user' => auth()->user()->id, 'post' => $post->id]) !!}">Add to bookmark</a> --}}
                        @if (!$post->bookmarks->where('user_id', auth()->user()->id)->count())
                            <form
                                action="/bookmark"
                                method="POST"
                            >
                                @csrf
                                <input
                                    type="hidden"
                                    name="user_id"
                                    id="user_id"
                                    value="{{ auth()->user()->id }}"
                                >
                                <input
                                    type="hidden"
                                    name="post_id"
                                    id="post_id"
                                    value="{{ $post->id }}"
                                >
                                <button
                                    type="submit"
                                    class="hover:underline hover:text-blue-600 text-blue-500"
                                >Add to bookmark</button>
                            </form>
                        @else
                            <p class="text-red-400">Added to bookmarks</p>
                        @endif
                    </div>
                    <img
                        src={{ asset('storage/thumbnails/' . $post->thumbnail) }}
                        alt=""
                        class="rounded-xl"
                    >
                    <span class="text-center mt-4 block -mb-2 text-sm text-gray-600">By</span>
                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        <x-avatar :photo="$post->author->avatar" />
                        <div class="ml-3 text-left">
                            <a href="/?author={{ $post->author->username }}">
                                <h5 class="font-bold"> {{ $post->author->name }} </h5>
                            </a>
                        </div>
                    </div>

                    @if ($post->author->id !== auth()->user()->id && )
                        <x-follow-button :post="$post" />
                    @endif
                    {{-- <x-follow-button :post="$post" /> --}}

                    <p class="mt-4 block text-gray-400 text-xs">
                        Published <time> {{ $post->created_at->diffForHumans() }} </time>
                    </p>

                    <p class="mt-4 block text-gray-400 text-xs">
                        This post has been viewed {{ $post->no_views }} time{{ $post->no_views > 1 ? 's' : '' }}
                    </p>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a
                            href="/"
                            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500"
                        >
                            <svg
                                width="22"
                                height="22"
                                viewBox="0 0 22 22"
                                class="mr-2"
                            >
                                <g
                                    fill="none"
                                    fill-rule="evenodd"
                                >
                                    <path
                                        stroke="#000"
                                        stroke-opacity=".012"
                                        stroke-width=".5"
                                        d="M21 1v20.16H.84V1z"
                                    >
                                    </path>
                                    <path
                                        class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"
                                    >
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category="$post->category" />
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        <p>
                            {!! $post->body !!}
                        </p>
                    </div>

                    <section class="col-span-8 col-start-5 mt-10 space-y-6">
                        @include('posts._add-comment-form')
                        @foreach ($post->comments as $comment)
                            <x-post-comment
                                :comment="$comment"
                                :currentUser="auth()->user()->username"
                            />
                        @endforeach
                    </section>
                </div>
            </article>
        </main>
    </section>

</x-layout>
