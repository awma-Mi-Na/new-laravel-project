@component('mail::message')
# New Post Published

A new post has been published by {{$author}}.  
Title: {{$title}}

![Thumbnail](http://laravel.test/storage/thumbnails/{{$thumbnail}})

@component('mail::button', ['url' => $url])
Visit Blog
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
