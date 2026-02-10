@extends('layouts.app')
@section('title', 'Trainer Dashboard')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="mb-8">
            <h1 class="text-3xl font-bold">Trainer <span class="gradient-text">Dashboard</span></h1>
            <p class="text-surface-500 mt-1">Manage your assigned courses and track students</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                <span class="text-surface-400 text-sm">Assigned Courses</span>
                <p class="text-3xl font-bold text-primary-600 mt-1">{{ $courses->count() }}</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                <span class="text-surface-400 text-sm">Total Students</span>
                <p class="text-3xl font-bold text-primary-600 mt-1">{{ $totalStudents }}</p>
            </div>
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                <span class="text-surface-400 text-sm">Status</span>
                <p class="text-lg font-bold text-green-600 mt-1"><i class="fas fa-check-circle mr-1"></i> Approved</p>
            </div>
        </div>

        <h2 class="text-xl font-bold mb-4">Your Courses</h2>
        @forelse($courses as $course)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100 mb-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-lg">{{ $course->name }}</h3>
                        <p class="text-surface-500 text-sm">{{ $course->level }} • {{ $course->duration }}</p>
                    </div>
                    <div class="text-sm text-surface-500">
                        <span
                            class="font-semibold text-primary-600">{{ $course->enrollments->where('status', 'completed')->count() }}</span>
                        enrolled students
                    </div>
                </div>
            </div>
        @empty
            <p class="text-surface-500">No courses assigned yet.</p>
        @endforelse
    </section>
@endsection