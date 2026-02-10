{{-- Navbar Partial --}}
<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-surface-200 transition-shadow duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <div
                    class="w-9 h-9 bg-gradient-to-br from-primary-500 to-accent-500 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-lg">T</span>
                </div>
                <span class="text-xl font-bold gradient-text hidden sm:inline">TheCodingScience</span>
            </a>

            {{-- Desktop Nav --}}
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Home</a>
                <a href="{{ route('about') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('about') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">About</a>
                <a href="{{ route('courses') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('courses') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Courses</a>
                <a href="{{ route('services') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('services') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Services</a>
                <a href="{{ route('internships') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('internships') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Internships</a>
                <a href="{{ route('blog') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('blog*') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Blog</a>
                <a href="{{ route('contact') }}"
                    class="px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 hover:text-primary-600 transition {{ request()->routeIs('contact') ? 'text-primary-600 bg-primary-50' : 'text-surface-600' }}">Contact</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="hidden md:flex items-center space-x-3">
                @guest
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-sm font-medium text-primary-600 hover:bg-primary-50 rounded-lg transition">Login</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary-500 to-accent-500 rounded-lg hover:shadow-lg hover:shadow-primary-500/25 transition">Sign
                        Up</a>
                @else
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 text-sm font-medium text-primary-600 hover:bg-primary-50 rounded-lg transition">
                        <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-surface-600 hover:bg-surface-100 rounded-lg transition">Logout</button>
                    </form>
                @endguest
            </div>

            {{-- Mobile Hamburger --}}
            <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg hover:bg-surface-100 transition"
                onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <i class="fas fa-bars text-surface-600"></i>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden pb-4 space-y-1">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Home</a>
            <a href="{{ route('about') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">About</a>
            <a href="{{ route('courses') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Courses</a>
            <a href="{{ route('services') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Services</a>
            <a href="{{ route('internships') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Internships</a>
            <a href="{{ route('blog') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Blog</a>
            <a href="{{ route('contact') }}"
                class="block px-3 py-2 rounded-lg text-sm font-medium hover:bg-primary-50 text-surface-600">Contact</a>
            <hr class="border-surface-200 my-2">
            @guest
                <a href="{{ route('login') }}"
                    class="block px-3 py-2 rounded-lg text-sm font-medium text-primary-600">Login</a>
                <a href="{{ route('register') }}"
                    class="block px-3 py-2 rounded-lg text-sm font-medium text-white bg-primary-600 text-center">Sign Up</a>
            @else
                <a href="{{ route('dashboard') }}"
                    class="block px-3 py-2 rounded-lg text-sm font-medium text-primary-600">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-surface-600 hover:bg-surface-100">Logout</button>
                </form>
            @endguest
        </div>
    </div>
</nav>