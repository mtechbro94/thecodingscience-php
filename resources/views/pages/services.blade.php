@extends('layouts.app')
@section('title', 'Services')
@section('meta_description', 'Explore our services in Computer Science Engineering, AI, Programming, and Cloud Computing.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">Our <span class="text-primary-200">Services</span></h1>
            <p class="mt-4 text-lg text-primary-100 max-w-xl mx-auto">Comprehensive training programs tailored for your
                career growth.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($services as $s)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100 card-hover">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center">
                            <i class="fas {{ $s['icon'] }} text-2xl text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-bold">{{ $s['title'] }}</h3>
                    </div>
                    <p class="text-surface-600 leading-relaxed mb-6">{{ $s['description'] }}</p>
                    <div class="flex items-center justify-between text-sm text-surface-500">
                        <span><i class="fas fa-clock mr-1 text-primary-500"></i> {{ $s['duration'] }}</span>
                        <span class="font-bold text-primary-600 text-lg">₹{{ $s['price'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection