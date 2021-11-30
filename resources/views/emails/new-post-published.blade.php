<x-layout>
    A new post has been published by: {{ $author->name }}
    <br />
    Title of post: {{ $title }}
    <br />
    <img
        src="{{ $message->embed(asset('storage/thumbnails/' . $thumbnail)) }}"
        alt="thumbnail"
    >
</x-layout>
