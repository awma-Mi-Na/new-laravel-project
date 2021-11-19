<x-layout>
    <x-setting :heading="'Edit post: '. $post->title ">
        <form
            action="/admin/posts/{{ $post->id }}"
            method="post"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PATCH')
            <x-form.input
                field="title"
                value="{{ old('title', $post->title) }}"
            />

            <x-form.input
                field='slug'
                value="{{ old('slug', $post->slug) }}"
            />

            <div class="flex justify-between mt-6">
                <x-form.input
                    field='thumbnail'
                    type='file'
                />
                <img
                    src={{ asset('storage/' . $post->thumbnail) }}
                    alt=""
                    class="rounded-xl"
                    width="100"
                >
            </div>

            <x-form.textarea field='excerpt'>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea
                field='body'
                rows='6'
            >{{ old('body', $post->body) }}</x-form.textarea>


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
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}
                        >{{ ucwords($category->name) }}</option>
                    @endforeach
                </select>
                <x-form.error field="category" />
            </x-form.field>

            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>
