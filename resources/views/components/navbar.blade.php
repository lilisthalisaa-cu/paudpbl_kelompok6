<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">

        {{-- Logo --}}
        <div class="font-bold text-lg text-green-600">
            PAUD App
        </div>

        {{-- Menu --}}
        <div class="flex gap-6">

            <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')">
                Dashboard
            </x-nav-link>

            <x-nav-link href="{{ route('admin.teachers.index') }}" :active="request()->routeIs('admin.teachers.*')">
                Guru
            </x-nav-link>

            <x-nav-link href="{{ route('admin.students.index') }}" :active="request()->routeIs('admin.students.*')">
                Siswa
            </x-nav-link>

        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500">Logout</button>
        </form>

    </div>
</nav>