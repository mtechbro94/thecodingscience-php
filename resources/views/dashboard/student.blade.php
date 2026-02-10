@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold">Welcome, <span class="gradient-text">{{ auth()->user()->name }}</span></h1>
                <p class="text-surface-500 mt-1">Track your enrollments and course progress</p>
            </div>
        </div>

        @if($enrollments->isEmpty())
            <div class="bg-white rounded-2xl p-12 shadow-sm border border-surface-100 text-center">
                <i class="fas fa-graduation-cap text-5xl text-surface-300 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">No Enrollments Yet</h3>
                <p class="text-surface-500 mb-6">Explore our courses and start your learning journey!</p>
                <a href="{{ route('courses') }}"
                    class="px-6 py-3 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition">Browse
                    Courses</a>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($enrollments as $enrollment)
                    <div
                        class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-laptop-code text-primary-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold">{{ $enrollment->course->name }}</h3>
                            <p class="text-surface-500 text-sm">Enrolled {{ $enrollment->created_at->diffForHumans() }}</p>
                        </div>
                        <div>
                            @if($enrollment->status === 'completed')
                                <span class="px-4 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-semibold"><i
                                        class="fas fa-check-circle mr-1"></i>Verified</span>
                            @else
                                <span class="px-4 py-1.5 bg-yellow-100 text-yellow-700 rounded-full text-sm font-semibold"><i
                                        class="fas fa-clock mr-1"></i>Pending</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection