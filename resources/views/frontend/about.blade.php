@extends('layouts.app')

@section('title', 'About Me')

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">About Me</h1>
        <p class="text-gray-400">Learn more about me and my journey</p>
    </div>
</section>

{{-- ════════ ABOUT CONTENT ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                @if($about && $about->image)
                <img src="{{ asset('storage/' . $about->image) }}" alt="About" class="rounded-2xl shadow-xl">
                @else
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl p-12 text-center">
                    <i class="fas fa-user text-8xl text-blue-600"></i>
                </div>
                @endif
            </div>
            
            <div>
                <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">About Me</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    {{ $about->title ?? 'Passionate Developer & AI Enthusiast' }}
                </h3>
                <div class="text-gray-600 mb-6 space-y-4">
                    {!! $about->content ?? '<p>I am a passionate developer with expertise in AI, Machine Learning, and Web Development. I love sharing knowledge through my blog and helping others learn.</p>' !!}
                </div>
                
                @if($about && $about->skills)
                <div class="mb-8">
                    <h4 class="font-semibold text-gray-900 mb-4">Tech Stack</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($about->skills as $skill)
                        <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($about && $about->resume_url)
                <a href="{{ $about->resume_url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                    <i class="fas fa-download mr-2"></i>Download Resume
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ════════ TESTIMONIALS ════════ --}}
@if($testimonials->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">Testimonials</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-gray-900">What People Say</h3>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white rounded-2xl p-8 shadow-lg">
                <div class="flex items-center gap-1 mb-4 text-yellow-400">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="text-gray-600 mb-6 italic">"{{ $testimonial->message }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr($testimonial->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold">{{ $testimonial->name }}</p>
                        @if($testimonial->designation)
                        <p class="text-sm text-gray-500">{{ $testimonial->designation }}@if($testimonial->company), {{ $testimonial->company }}@endif</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════ SOCIAL LINKS ════════ --}}
<section class="py-20 bg-gray-900">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-2xl font-bold text-white mb-8">Connect With Me</h2>
        <div class="flex flex-wrap gap-4 justify-center">
            @foreach($socialLinks as $link)
            <a href="{{ $link->url }}" target="_blank" class="w-14 h-14 bg-white/10 hover:bg-blue-600 rounded-full flex items-center justify-center text-white transition-all text-xl">
                <i class="{{ $link->icon }}"></i>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
