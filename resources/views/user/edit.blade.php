<x-layout>
    {{-- {{ dd(auth()->user()->username) }} --}}
    <section class="max-w-3xl mx-auto py-8 ">
        <form
            action="/user/{{ $user->username }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PATCH')
            <div>
                <x-form.input
                    field="avatar"
                    type="file"
                />

                {{-- <img
                    src="{{ asset("storage/thumbnails/$user->avatar") }}"
                    alt="avatar"
                    class="rounded-full w-24 h-24 object-cover"
                > --}}
                <x-avatar
                    :photo="$user->avatar"
                    class="h-24 w-24"
                />
            </div>

            <x-form.input
                field="name"
                value="{{ old('name', $user->name) }}"
            />
            <x-form.input
                field="username"
                value="{{ old('username', $user->username) }}"
            />
            <x-form.input
                field="email"
                value="{{ old('email', $user->email) }}"
            />



            <x-form.button>Confirm changes</x-form.button>

        </form>
    </section>
</x-layout>
