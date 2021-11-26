<x-layout>
    <x-setting heading="Bookmarks">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Title
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Author
                                    </th>
                                    <th
                                        scope="col"
                                        class="relative px-6 py-3"
                                    >
                                        <span class="sr-only">Delete</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($bookmarks->count())

                                    @foreach ($bookmarks as $bookmark)
                                        <tr>
                                            <td class="px-6 py-4">
                                                <a
                                                    href="/posts/{{ $bookmark->post->slug }}"
                                                    class="text-sm text-gray-900"
                                                >{{ $bookmark->post->title }}</a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $bookmark->post->author->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <form
                                                    action="/bookmark/{{ $bookmark->id }}"
                                                    method="post"
                                                    x-data="{conf: false, check: false}"
                                                    @submit.prevent="if(conf == false) return;$el.submit()"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="text-xs text-blue-400 hover:text-red-400"
                                                        @click="check = confirm('are you sure you want to delete: {{ $bookmark->post->title }}?'); conf = check;"
                                                    >Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <p>No bookmarks yet</p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </x-setting>
</x-layout>
