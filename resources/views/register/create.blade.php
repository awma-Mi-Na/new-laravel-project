<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-6 bg-gray-100 border border-gray-200 rounded-xl p-6">
            <h1 class="text-xl font-bold text-center mb-10">Register!</h1>
            <form
                action=""
                method="post"
            >
                @csrf
                <div class="mb-4">
                    <label
                        class="block uppercase mb-2 font-bold text-sm text-gray-700"
                        for="name"
                    >Name</label>
                    <input
                        class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old('name') }}"
                    >

                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label
                        class="block uppercase mb-2 font-bold text-sm text-gray-700"
                        for="username"
                    >Username</label>
                    <input
                        class="border border-gray-400 p-2 w-full"
                        type="text"
                        name="username"
                        id="username"
                        value="{{ old('username') }}"
                    >
                    @error('username')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label
                        class="block uppercase mb-2 font-bold text-sm text-gray-700"
                        for="email"
                    >Email</label>
                    <input
                        class="border border-gray-400 p-2 w-full"
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label
                        class="block uppercase mb-2 font-bold text-sm text-gray-700"
                        for="password"
                    >Password</label>
                    <input
                        class="border border-gray-400 p-2 w-full"
                        type="password"
                        name="password"
                        id="password"
                    >
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <button
                        type="submit"
                        class="bg-blue-400 px-6 py-2 rounded-lg text-white hover:bg-blue-500"
                    >Submit</button>
                </div>

                {{-- to display all the errors --}}
                {{-- @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-xs text-red-500 mt-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif --}}
            </form>
        </main>
    </section>
</x-layout>
