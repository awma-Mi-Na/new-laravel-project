<x-layout>
    <section class="max-w-3xl mx-auto mt-4">

        <form
            action="/posts/{{ auth()->user()->username }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            <x-form.input field="title" />

            <x-form.input field='slug' />

            <x-form.input
                field='thumbnail'
                type='file'
            />

            <x-form.textarea field='excerpt' />
            <x-form.textarea
                field='body'
                rows='6'
            />


            <x-form.field>

                <x-form.label field="category" />
                @php
                    $categories = \App\Models\Category::all();
                @endphp


                <select
                    name="category_id"
                    id="category_id"
                >
                    @foreach ($categories as $category)

                        <option
                            value={{ $category->id }}
                            {{ old('category_id') == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error field="category" />
            </x-form.field>

            <div class="flex items-center gap-4">

                {{-- <x-form.button>Publish</x-form.button> --}}

                <x-form.field>
                    <button
                        type="submit"
                        class="text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-green-600 bg-green-500"
                        name="in_draft"
                        value="1"
                    >Submit draft</button>
                </x-form.field>
            </div>


        </form>
    </section>
</x-layout>
