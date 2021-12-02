<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>

                <h1 class="text-xl font-bold text-center mb-10">Register!</h1>
                <form
                    action="/register"
                    method="post"
                >
                    @csrf
                    <x-form.input field="name" />
                    <x-form.input field="username" />
                    <x-form.input
                        field="email"
                        type="email"
                        autocomplete="email"
                    />

                    <x-form.password-showable />

                    <x-form.button>Submit</x-form.button>

                    {{-- to display all the errors --}}
                    {{-- @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-xs text-red-500 mt-1">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif --}}
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
