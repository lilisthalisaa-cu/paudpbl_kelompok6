<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <div class="flex">

                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ auth()->check() 
                        ? (auth()->user()->role === 'admin' 
                            ? route('admin.dashboard') 
                            : (auth()->user()->role === 'teacher' 
                                ? route('teacher.dashboard') 
                                : route('parent.dashboard')))
                        : route('login') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <x-nav-link 
                        :href="auth()->check() 
                            ? (auth()->user()->role === 'admin' 
                                ? route('admin.dashboard') 
                                : (auth()->user()->role === 'teacher' 
                                    ? route('teacher.dashboard') 
                                    : route('parent.dashboard')))
                            : route('login')"

                        :active="request()->routeIs('admin.dashboard') 
                            || request()->routeIs('teacher.dashboard') 
                            || request()->routeIs('parent.dashboard')">
                        Dashboard
                    </x-nav-link>

                    @guest
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            Login
                        </x-nav-link>
                    @endguest

                </div>
            </div>

            <!-- User Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-500 bg-white hover:text-gray-700">
                            <div>{{ auth()->user()->name }}</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Logout
                            </x-dropdown-link>
                        </form>
                    </x-slot>

                </x-dropdown>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open">
                    ☰
                </button>
            </div>

        </div>
    </div>

    <!-- Responsive -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <x-responsive-nav-link 
            :href="auth()->check() 
                ? (auth()->user()->role === 'admin' 
                    ? route('admin.dashboard') 
                    : (auth()->user()->role === 'teacher' 
                        ? route('teacher.dashboard') 
                        : route('parent.dashboard')))
                : route('login')">

            Dashboard
        </x-responsive-nav-link>

    </div>
</nav>