@extends('layouts.app')

@section('title', 'Services')

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Services</h1>
        <p class="text-gray-400">Explore what I can do for you</p>
    </div>
</section>

{{-- ════════ SERVICES ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($services->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all border border-gray-100">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="{{ $service->icon ?? 'fas fa-code' }} text-2xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                @if($service->content)
                <a href="{{ route('service.detail', $service->slug) }}" class="text-blue-600 font-semibold hover:text-blue-700">
                    Learn More <i class="fas fa-arrow-right ml-1"></i>
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-tools text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No services available yet.</p>
        </div>
        @endif
    </div>
</section>

{{-- ════════ CTA ════════ --}}
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Need Help With Something?</h2>
        <p class="text-white/80 mb-8">Let's discuss your project and see how I can help.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-all">
            <i class="fas fa-envelope mr-2"></i>Get In Touch
        </a>
    </div>
</section>
@endsection
