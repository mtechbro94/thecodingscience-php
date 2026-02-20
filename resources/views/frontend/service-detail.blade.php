@extends('layouts.app')

@section('title', $service->title)

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $service->title }}</h1>
        <p class="text-gray-400">Service Details</p>
    </div>
</section>

{{-- ════════ SERVICE DETAIL ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto">
            <div class="w-20 h-20 bg-blue-100 rounded-2xl flex items-center justify-center mb-8">
                <i class="{{ $service->icon ?? 'fas fa-code' }} text-3xl text-blue-600"></i>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-900 mb-6">About This Service</h2>
            <div class="text-gray-600 prose max-w-none mb-8">
                {!! nl2br(e($service->description)) !!}
            </div>
            
            @if($service->content)
            <div class="bg-gray-50 rounded-2xl p-8 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">What's Included</h3>
                <div class="text-gray-600 prose max-w-none">
                    {!! nl2br(e($service->content)) !!}
                </div>
            </div>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                    <i class="fas fa-envelope mr-2"></i>Request Quote
                </a>
                <a href="{{ route('projects') }}" class="inline-flex items-center justify-center px-6 py-3 border-2 border-gray-300 hover:border-gray-900 text-gray-900 font-semibold rounded-lg transition-all">
                    <i class="fas fa-briefcase mr-2"></i>View Projects
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
