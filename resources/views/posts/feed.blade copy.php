<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <id>{{ url('/feed') }}</id>
    <link href="{{ url('/feed') }}">
    </link>
    <title>
        <![CDATA[{{ config('app.name') }}]]>
    </title>
    <description></description>
    <language></language>
    <updated>{{ $posts->first()->updated_at->format('D, d M Y H:i:s +0000') }}</updated>
    @foreach ($posts as $post)
        <entry>
            <title>
                <![CDATA[{{ $post->title }}]]>
            </title>
            <link
                rel="alternate"
                href="/posts/{{ $post->slug }}"
            />
            <id>{{ $post->slug }}</id>
            <author>
                <name>
                    <![CDATA[{{ $post->author->name }}]]>
                </name>
            </author>
            {{-- <summary type="html">
                <![CDATA[{!! parsedown($post->content) !!}]]>
            </summary> --}}
            <category type="html">
                <![CDATA[{{ $post->category }}]]>
            </category>
            <updated>{{ $post->updated_at->format('D, d M Y H:i:s +0000') }}</updated>`
        </entry>
    @endforeach
</feed>
