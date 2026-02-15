@extends('layouts.app')
@section('title', 'Home')

@section('content')
    {{-- HERO SECTION --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-surface-900 via-primary-900 to-surface-900 text-white">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-20 left-10 w-72 h-72 bg-primary-500 rounded-full filter blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-accent-500 rounded-full filter blur-3xl animate-pulse"
                style="animation-delay:.5s"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 py-24 sm:py-32 lg:py-40 text-center">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight animate-fade-in">
                {{ \App\Models\SiteSetting::get('hero_title', 'Master the Future of Tech') }}
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-surface-300 max-w-2xl mx-auto animate-fade-in"
                style="animation-delay:.2s">
                {{ \App\Models\SiteSetting::get('hero_subtitle', 'Industry-ready courses in Full Stack Development, AI, Data Science, Cybersecurity & more.') }}
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center animate-fade-in" style="animation-delay:.4s">
                <a href="{{ \App\Models\SiteSetting::get('hero_cta_link', route('courses')) }}"
                    class="px-8 py-3.5 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold rounded-xl hover:shadow-2xl hover:shadow-primary-500/30 transition-all transform hover:scale-105">
                    {{ \App\Models\SiteSetting::get('hero_cta_text', 'Explore Courses') }} <i
                        class="fas fa-arrow-right ml-2"></i>
                </a>
                <a href="{{ route('about') }}"
                    class="px-8 py-3.5 border border-white/20 text-white font-semibold rounded-xl hover:bg-white/10 transition-all">
                    Learn More
                </a>
            </div>
            {{-- Stats --}}
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto animate-fade-in"
                style="animation-delay:.6s">
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-400">9+</div>
                    <div class="text-sm text-surface-400 mt-1">Courses</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-400">500+</div>
                    <div class="text-sm text-surface-400 mt-1">Students</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-400">10+</div>
                    <div class="text-sm text-surface-400 mt-1">Expert Trainers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-primary-400">95%</div>
                    <div class="text-sm text-surface-400 mt-1">Satisfaction</div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURED COURSES --}}
    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12">
            <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Our Programs</span>
            <h2 class="text-3xl sm:text-4xl font-bold mt-2">Featured <span class="gradient-text">Courses</span></h2>
            <p class="text-surface-500 mt-3 max-w-xl mx-auto">Handcrafted courses designed to take you from beginner to
                industry-ready professional.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($courses as $course)
                <div class="bg-white rounded-2xl shadow-sm border border-surface-100 overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-primary-100 to-accent-100 flex items-center justify-center">
                        @if($course->image)
                            <img src="{{ str_starts_with($course->image, 'courses/') ? Storage::url($course->image) : asset('images/' . $course->image) }}"
                                alt="{{ $course->name }}" class="h-full w-full object-cover">
                        @else
                            <i class="fas fa-laptop-code text-5xl text-primary-400"></i>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span
                                class="px-2 py-1 bg-primary-50 text-primary-700 text-xs font-semibold rounded-full">{{ $course->level }}</span>
                            <span class="text-surface-400 text-xs"><i
                                    class="fas fa-clock mr-1"></i>{{ $course->duration }}</span>
                        </div>
                        <h3 class="text-lg font-bold text-surface-800 mb-2">{{ $course->name }}</h3>
                        <p class="text-surface-500 text-sm leading-relaxed mb-4">{{ $course->summary }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary-600">₹{{ number_format($course->price) }}</span>
                            <a href="{{ route('course.detail', $course) }}"
                                class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('courses') }}"
                class="inline-flex items-center px-6 py-3 border-2 border-primary-600 text-primary-600 font-semibold rounded-xl hover:bg-primary-600 hover:text-white transition">
                View All Courses <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </section>

    {{-- WHY CHOOSE US --}}
    <section class="bg-surface-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary-400 font-semibold text-sm uppercase tracking-wider">Why Us</span>
                <h2 class="text-3xl sm:text-4xl font-bold mt-2">Why Choose <span class="text-primary-400">The Coding
                        Science?</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $features = [
                        ['icon' => 'fa-chalkboard-teacher', 'title' => 'Expert Trainers', 'desc' => 'Learn from industry professionals with real-world experience.'],
                        ['icon' => 'fa-project-diagram', 'title' => 'Hands-on Projects', 'desc' => 'Build portfolio-worthy projects from day one.'],
                        ['icon' => 'fa-certificate', 'title' => 'Certification', 'desc' => 'Earn recognized certificates upon course completion.'],
                        ['icon' => 'fa-headset', 'title' => '24/7 Support', 'desc' => 'Dedicated WhatsApp group support and doubt sessions.'],
                    ];
                @endphp
                @foreach($features as $f)
                    <div class="text-center p-6 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition">
                        <div class="w-14 h-14 mx-auto bg-primary-500/20 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas {{ $f['icon'] }} text-2xl text-primary-400"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ $f['title'] }}</h3>
                        <p class="text-surface-400 text-sm">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- LATEST BLOGS --}}
    @if($blogs->count())
        <section class="max-w-7xl mx-auto px-4 py-20">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">From Our Blog</span>
                <h2 class="text-3xl sm:text-4xl font-bold mt-2">Latest <span class="gradient-text">Insights</span></h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($blogs as $blog)
                    <a href="{{ route('blog.detail', $blog) }}"
                        class="bg-white rounded-2xl shadow-sm border border-surface-100 overflow-hidden card-hover group">
                        <div
                            class="h-48 bg-gradient-to-br from-primary-50 to-accent-50 flex items-center justify-center overflow-hidden">
                            @if($blog->image)
                                <img src="{{ str_starts_with($blog->image, 'blogs/') ? Storage::url($blog->image) : asset('images/' . $blog->image) }}"
                                    alt="{{ $blog->title }}" class="h-full w-full object-cover">
                            @else
                                <i class="fas fa-newspaper text-4xl text-primary-300 group-hover:scale-110 transition-transform"></i>
                            @endif
                        </div>
                        <div class="p-6">
                            <span
                                class="text-xs text-surface-400">{{ $blog->display_date ?? $blog->created_at->format('M d, Y') }}</span>
                            <h3 class="text-lg font-bold mt-2 group-hover:text-primary-600 transition">{{ $blog->title }}</h3>
                            <p class="text-surface-500 text-sm mt-2 line-clamp-2">{{ $blog->excerpt }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="bg-gradient-to-r from-primary-600 to-accent-600 text-white py-16">
        <div class="max-w-4xl mx-auto text-center px-4">
            <h2 class="text-3xl sm:text-4xl font-bold">Ready to Start Your Journey?</h2>
            <p class="mt-4 text-lg text-white/80">Join thousands of students building their tech careers with The Coding
                Science.</p>
            <a href="{{ route('register') }}"
                class="mt-8 inline-block px-8 py-3.5 bg-white text-primary-600 font-bold rounded-xl hover:shadow-xl transition-all transform hover:scale-105">
                Get Started Free <i class="fas fa-rocket ml-2"></i>
            </a>
        </div>
    </section>
@endsection