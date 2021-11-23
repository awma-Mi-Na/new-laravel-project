<x-layout>
    <section class="max-w-3xl mx-auto py-8 ">
        <form
            action="/comment/{{ $comment->id }}"
            method="POST"
        >
            @csrf
            @method('patch')
            <x-form.input
                field="body"
                value="{{ $comment->body }}"
            />
            <x-form.button>Submit changes</x-form.button>
        </form>
    </section>
</x-layout>
