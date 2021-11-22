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

            <x-form.field>

                <x-form.label field="author" />
                @php
                    $authors = \App\Models\User::all();
                @endphp


                <select
                    name="user_id"
                    id="user_id"
                >
                    @foreach ($authors as $author)

                        <option
                            value={{ $author->id }}
                            {{ old('user_id', $post->user_id) == $author->id ? 'selected' : '' }}
                        >{{ ucwords($author->name) }}</option>
                    @endforeach
                </select>
                <x-form.error field="author" />
            </x-form.field>

            {{-- <x-form.button
                name="in_draft"
                value="0"
            >Update</x-form.button> --}}
            <x-form.field>
                <button
                    type="submit"
                    class="text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-green-600 bg-green-500"
                    name="in_draft"
                    value="1"
                >Save as draft</button>
            </x-form.field>
            <x-form.field>
                <button
                    type="submit"
                    class="text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-green-600 bg-green-500"
                    name="in_draft"
                    value="0"
                >Update</button>
            </x-form.field>
        </form>
    </x-setting>
</x-layout>
