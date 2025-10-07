<x-layout title="Login">


    <div class="max-w-sm mx-auto mt-8 ">
        <div class="flex items-center justify-between mb-6 px-10">
            <h1 class="text-2xl font-bold mb-4 text-white">Login</h1>
            <a href="{{ route('post.index') }}">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                </svg>

            </a>
        </div>

        <form method="POST" action="{{ route('login.post') }}"
            class="p-5 border border-gray-300 rounded-lg shadow-sm bg-white dark:bg-gray-400">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @if ($errors->has('email'))
                    <p class="text-red-500 text-xs italic mt-2">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <input type="checkbox" name="remember" id="remember" class="mr-2 leading-tight">
                <label for="remember" class="text-sm text-gray-700">Remember Me</label>
            </div>

            <div class="flex items-center justify-between gap-4 flex-col">
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 w-full text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Login
                </button>
                <p>Don't You have any Account? Please <a href="{{ route('register.get') }}"
                        class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800">
                        Register
                    </a></p>
            </div>
        </form>
    </div>
</x-layout>
