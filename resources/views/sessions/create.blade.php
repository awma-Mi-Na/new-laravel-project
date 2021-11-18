<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-xl font-bold text-center mb-10">Log In!</h1>
                <form
                    action="/login"
                    method="post"
                >
                    @csrf

                    <x-form.input
                        field="email"
                        type="email"
                        aria-autocomplete="email"
                    />

                    <x-form.input
                        field="password"
                        type="password"
                        aria-autocomplete="current-password"
                    />

                    <x-form.button>Log In</x-form.button>

                </form>

            </x-panel>
        </main>
    </section>
</x-layout>
