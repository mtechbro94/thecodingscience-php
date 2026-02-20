{{-- Footer Partial --}}
<footer class="bg-surface-900 text-surface-200 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            {{-- Brand --}}
            <div class="md:col-span-1">
                <div class="flex items-center space-x-2 mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-primary-400 to-accent-400 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">M</span>
                    </div>
                    <span class="text-xl font-bold text-white">AIwithMir</span>
                </div>
                <p class="text-surface-400 text-sm leading-relaxed">TheCodingScience Blogs - Exploring AI, Machine Learning, Web Development and Technology.</p>

                <div class="flex space-x-4 mt-6">
                    <a href="#" class="w-9 h-9 bg-surface-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-github text-sm"></i></a>
                    <a href="#" class="w-9 h-9 bg-surface-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-linkedin text-sm"></i></a>
                    <a href="#" class="w-9 h-9 bg-surface-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-twitter text-sm"></i></a>
                    <a href="#" class="w-9 h-9 bg-surface-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition"><i class="fab fa-instagram text-sm"></i></a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-primary-400 transition">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-primary-400 transition">About</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-primary-400 transition">Services</a></li>
                    <li><a href="{{ route('projects') }}" class="hover:text-primary-400 transition">Projects</a></li>
                    <li><a href="{{ route('blog') }}" class="hover:text-primary-400 transition">Blog</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-primary-400 transition">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Services</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('services') }}" class="hover:text-primary-400 transition">Web Development</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-primary-400 transition">AI Solutions</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-primary-400 transition">Machine Learning</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-primary-400 transition">Consulting</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div>
                <h4 class="text-white font-semibold mb-4">Stay Updated</h4>
                <p class="text-surface-400 text-sm mb-4">Subscribe to newsletter for latest articles and tech insights.</p>
                <form method="POST" action="{{ route('newsletter.subscribe') }}" class="flex">
                    @csrf
                    <input type="email" name="email" required placeholder="Your email"
                        class="flex-1 px-3 py-2 bg-surface-800 border border-surface-700 rounded-l-lg text-sm focus:outline-none focus:border-primary-500 text-white">
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-r-lg hover:bg-primary-700 transition text-sm font-medium">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <hr class="border-surface-700 my-8">
        <div class="text-center text-surface-500 text-sm">
            &copy; {{ date('Y') }} AIwithMir - TheCodingScience Blogs. All rights reserved.
        </div>
    </div>
</footer>
