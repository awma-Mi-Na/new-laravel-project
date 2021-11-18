<x-layout>
    <x-setting heading="Publish a new post">
        <form
            action="/admin/posts"
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

            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>
