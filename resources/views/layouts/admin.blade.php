<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | TCS Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { fontFamily: { sans: ['Inter', 'sans-serif'] }, colors: { primary: { 50: '#eef2ff', 100: '#e0e7ff', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81' } } } } }</script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 text-gray-800">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-gray-300 flex-shrink-0 hidden lg:flex flex-col">
            <div class="px-6 py-5 border-b border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold text-white"><i
                        class="fas fa-shield-alt text-primary-500 mr-2"></i>TCS Admin</a>
            </div>
            <nav class="flex-1 py-4 space-y-1 px-3 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-tachometer-alt w-5"></i>Dashboard</a>
                <a href="{{ route('admin.users') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.users') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-users w-5"></i>Users</a>
                <a href="{{ route('admin.courses') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.courses*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-book w-5"></i>Courses</a>
                <a href="{{ route('admin.enrollments') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.enrollments') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-credit-card w-5"></i>Enrollments</a>
                <a href="{{ route('admin.blogs') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.blogs*') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-newspaper w-5"></i>Blogs</a>
                <a href="{{ route('admin.contacts') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.contacts') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-envelope w-5"></i>Contacts</a>
                <a href="{{ route('admin.internships') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.internships') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-briefcase w-5"></i>Internships</a>
                <a href="{{ route('admin.reviews') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.reviews') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-star w-5"></i>Reviews</a>
                <a href="{{ route('admin.subscribers') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.subscribers') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-bell w-5"></i>Subscribers</a>
                <a href="{{ route('admin.settings') }}"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg {{ request()->routeIs('admin.settings') ? 'bg-primary-600 text-white' : 'hover:bg-gray-800' }}"><i
                        class="fas fa-cog w-5"></i>Settings</a>
            </nav>
            <div class="px-3 py-4 border-t border-gray-800">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 text-sm"><i
                        class="fas fa-globe w-5"></i>View Site</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-800 text-sm w-full text-left"><i
                            class="fas fa-sign-out-alt w-5"></i>Logout</button>
                </form>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col">
            <header class="bg-white border-b px-6 py-4 flex items-center justify-between">
                <h2 class="text-lg font-bold">@yield('title', 'Admin')</h2>
                <span class="text-sm text-gray-500">{{ auth()->user()->name }}</span>
            </header>

            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>