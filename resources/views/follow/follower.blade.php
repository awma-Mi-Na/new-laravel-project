<x-layout>
    <x-setting heading="Followers">
        <table class="min-w-full">
            <tbody>
                @if ($followers->count())
                    @foreach ($followers as $follower)
                        <tr>
                            <td>{{ $follower->follower->name }}</td>
                            <td>
                                <x-avatar :photo="$follower->follower->avatar" />
                            <td>
                        </tr>
                    @endforeach
                @else
                    <tr>You have no followers.</tr>
                @endif

                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </x-setting>
</x-layout>
