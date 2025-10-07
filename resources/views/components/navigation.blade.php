@php
    $isLogin = auth()->check();
@endphp




<nav class=" border-gray-200 bg-gray-900/70 shadow-sm relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">

        <!-- 1. Logo -->
        <a href="{{ route('post.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/logo/shayan_2.png" class="h-8" alt="Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">SHAYAN MART</span>
        </a>

        <!-- 2. Profile Dropdown & Hamburger Menu Wrapper -->
        <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">

            <!-- Profile Picture Dropdown Button -->
            @if ($isLogin)
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                    id="user-menu-button" aria-expanded="false">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full"
                        src="{{ auth()->user()->avatar ? '/avatar/' . auth()->user()->avatar : 'http://ui-avatars.com/api/?name=' . auth()->user()->name . '&background=random&color=random' }}"
                        alt="user photo">
                </button>
            @else
                <a href="{{ route('login.get') }}" class="text-white px-2 py-1 bg-[#DE4245] rounded hover:bg-red-700">
                    Login
                </a>
            @endif


            <!-- Dropdown Menu -->
            <div class="relative">

                <div class="z-50 absolute  right-6  hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                    id="user-dropdown">
                    @auth
                        @if (auth()->user()->is_admin)
                            <div class="px-4 py-3">
                                <span class="block text-sm text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                                <span
                                    class="block text-sm text-gray-500 truncate dark:text-gray-400">{{ auth()->user()->email }}</span>
                            </div>
                        @endif
                    @endauth

                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li><a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        <li><a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Settings</a>
                        </li>
                        <li><a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Earnings</a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                @csrf
                                <button type="submit">Sign out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Hamburger Menu Button (Mobile Only) -->
            <button id="hamburger-button" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-user" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>

        <!-- 3. Navigation Links (Middle Section) -->
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0   dark:border-gray-700">
                <li><a href="#"
                        class="block py-2 px-3 text-[#DE4245]   rounded md:bg-transparent md:text-[#DE4245]  md:p-0 md:dark:text-[#DE4245] dark:text-white"
                        aria-current="page">Home</a></li>
                <li><a href="#"
                        class="block py-2 px-3 text-[#DE4245]   hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#DE4245] md:p-0 dark:text-white md:dark:hover:text-[#DE4245]  dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                </li>
                <li><a href="#"
                        class="block py-2 px-3 text-[#DE4245]   hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#DE4245] md:p-0 dark:text-white md:dark:hover:text-[#DE4245]  dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                </li>
                <li><a href="#"
                        class="block py-2 px-3 text-[#DE4245]   hover:bg-gray-100 md:hover:bg-transparent md:hover:text-[#DE4245] md:p-0 dark:text-white md:dark:hover:text-[#DE4245]  dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Wait for the DOM to be fully loaded before running the script
    document.addEventListener('DOMContentLoaded', function() {
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');
        const hamburgerButton = document.getElementById('hamburger-button');
        const mobileMenu = document.getElementById('navbar-user');

        // Toggle user dropdown menu
        userMenuButton.addEventListener('click', function() {
            userDropdown.classList.toggle('hidden');
            const isExpanded = userMenuButton.getAttribute('aria-expanded') === 'true';
            userMenuButton.setAttribute('aria-expanded', !isExpanded);
        });

        // Toggle mobile menu
        hamburgerButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            const isExpanded = hamburgerButton.getAttribute('aria-expanded') === 'true';
            hamburgerButton.setAttribute('aria-expanded', !isExpanded);
        });

        // Optional: Close dropdown when clicking outside of it
        window.addEventListener('click', function(event) {
            if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                if (!userDropdown.classList.contains('hidden')) {
                    userDropdown.classList.add('hidden');
                    userMenuButton.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
</script>
