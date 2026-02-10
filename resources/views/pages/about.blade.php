@extends('layouts.app')
@section('title', 'About Us')
@section('meta_description', 'Learn about The Coding Science - our mission, values, and the team behind your tech education.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">About <span class="text-primary-200">Us</span></h1>
            <p class="mt-4 text-lg text-primary-100 max-w-2xl mx-auto">School of Technology and AI Innovations — empowering
                students with industry-ready technical skills since day one.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Our Story</span>
                <h2 class="text-3xl font-bold mt-2 mb-6">Bridging the Gap Between <span class="gradient-text">Education &
                        Industry</span></h2>
                <p class="text-surface-600 leading-relaxed mb-4">The Coding Science was founded with a simple mission: make
                    quality tech education accessible to everyone. We believe that practical, project-based learning is the
                    fastest path to a rewarding tech career.</p>
                <p class="text-surface-600 leading-relaxed">Our courses are designed by industry professionals who
                    understand what employers look for. From Full Stack Development to AI and Cybersecurity, we cover the
                    most in-demand skills of the modern tech landscape.</p>
            </div>
            <div class="bg-gradient-to-br from-primary-50 to-accent-50 rounded-2xl p-10 text-center">
                <div class="text-6xl font-extrabold gradient-text">500+</div>
                <p class="text-surface-600 mt-2 font-medium">Students Trained</p>
                <div class="grid grid-cols-2 gap-6 mt-8">
                    <div>
                        <div class="text-2xl font-bold text-primary-600">9</div>
                        <p class="text-sm text-surface-500">Courses</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-primary-600">10+</div>
                        <p class="text-sm text-surface-500">Trainers</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-primary-600">95%</div>
                        <p class="text-sm text-surface-500">Satisfaction</p>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-primary-600">3</div>
                        <p class="text-sm text-surface-500">Internships</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="bg-surface-100 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">What We Stand For</span>
                <h2 class="text-3xl font-bold mt-2">Our Core <span class="gradient-text">Values</span></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($values as $v)
                    <div class="bg-white rounded-2xl p-8 text-center shadow-sm card-hover">
                        <div class="w-14 h-14 mx-auto bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas {{ $v['icon'] }} text-2xl text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ $v['title'] }}</h3>
                        <p class="text-surface-500 text-sm">{{ $v['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection