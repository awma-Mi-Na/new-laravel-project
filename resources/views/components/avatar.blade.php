@props(['photo'])

<img
    src={{ asset('/storage/avatar/' . $photo) }}
    alt=""
    {{ $attributes->merge(['class' => 'rounded-full object-cover h-14 w-14']) }}
>
