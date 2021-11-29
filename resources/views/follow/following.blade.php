<x-layout>
    <x-setting heading="Followers">
        <table class="min-w-full">
            <tbody>
                @if ($followings->count())
                    @foreach ($followings as $following)
                        <tr>
                            <td>{{ $following->following->name }}</td>
                            <td>
                                <x-avatar :photo="$following->following->avatar" />
                            <td>
                            <td>
                                <form
                                    action="/unfollow/{{ $following->id }}"
                                    method="post"
                                    x-data="{conf: false, check: false}"
                                    @submit.prevent="if(conf == false) return;$el.submit()"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="text-xs text-blue-400 hover:text-red-400"
                                        @click="check = confirm('Are you sure you want to unfollow: {{ $following->following->name }}?'); conf = check;"
                                    >Unfollow</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        You don't follow any author.
                    </tr>
                @endif
            </tbody>
        </table>
    </x-setting>
</x-layout>
