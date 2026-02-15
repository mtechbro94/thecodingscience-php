@extends('layouts.app')
@section('title', 'All Courses')
@section('meta_description', 'Browse all courses at The Coding Science - Full Stack Development, Data Science, AI, Ethical Hacking and more.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">Our <span class="text-primary-200">Courses</span></h1>
            <p class="mt-4 text-lg text-primary-100 max-w-xl mx-auto">Industry-ready programs designed by experts. Pick your
                path and start building.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16">
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
    </section>
@endsection