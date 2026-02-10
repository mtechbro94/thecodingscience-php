<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="@yield('meta_description', 'The Coding Science - School of Technology and AI Innovations. Learn Full Stack Development, Data Science, AI, Ethical Hacking and more.')">
    <title>@yield('title', 'The Coding Science') | School of Technology & AI</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind CSS CDN (for quick start; replace with Vite build in production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: { 50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81' },
                        accent: { 400: '#f472b6', 500: '#ec4899', 600: '#db2777' },
                        surface: { 50: '#f8fafc', 100: '#f1f5f9', 200: '#e2e8f0', 800: '#1e293b', 900: '#0f172a' },
                    }
                }
            }
        }
    </script>

    <style>
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Glass morphism helper */
        .glass {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #6366f1, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Hover card lift */
        .card-hover {
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(99, 102, 241, .15);
        }

        /* Navbar shadow on scroll */
        .nav-scrolled {
            box-shadow: 0 4px 30px rgba(0, 0, 0, .08);
        }

        /* Fade-in animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp .6s ease-out both;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-surface-50 text-surface-800 antialiased">

    {{-- ════════ NAVBAR ════════ --}}
    @include('partials.navbar')

    {{-- ════════ FLASH MESSAGES ════════ --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between"
                role="alert">
                <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">&times;</button>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center justify-between"
                role="alert">
                <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">&times;</button>
            </div>
        </div>
    @endif
    @if(session('info'))
        <div class="max-w-7xl mx-auto px-4 mt-4">
            <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg flex items-center justify-between"
                role="alert">
                <span><i class="fas fa-info-circle mr-2"></i>{{ session('info') }}</span>
                <button onclick="this.parentElement.remove()" class="text-blue-600 hover:text-blue-800">&times;</button>
            </div>
        </div>
    @endif

    {{-- ════════ MAIN CONTENT ════════ --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- ════════ FOOTER ════════ --}}
    @include('partials.footer')

    {{-- ════════ SCROLL-TO-TOP ════════ --}}
    <button id="scrollTop" onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-6 right-6 w-12 h-12 bg-primary-600 text-white rounded-full shadow-lg hidden items-center justify-center hover:bg-primary-700 transition-all z-50">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            document.querySelector('nav').classList.toggle('nav-scrolled', window.scrollY > 40);
            document.getElementById('scrollTop').classList.toggle('hidden', window.scrollY < 300);
            document.getElementById('scrollTop').classList.toggle('flex', window.scrollY >= 300);
        });
    </script>

    @stack('scripts')
</body>

</html>