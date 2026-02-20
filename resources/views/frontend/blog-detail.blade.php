@extends('layouts.app')

@section('title', $blog->title)

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <p class="text-blue-400 mb-4">{{ $blog->display_date ?? $blog->created_at->format('M d, Y') }}</p>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $blog->title }}</h1>
            @if($blog->author)
            <p class="text-gray-400">By {{ $blog->author }}</p>
            @endif
        </div>
    </div>
</section>

{{-- ════════ BLOG CONTENT ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            {{-- Featured Image --}}
            @if($blog->image)
            <div class="rounded-2xl overflow-hidden mb-12">
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full">
            </div>
            @endif
            
            {{-- Content --}}
            <div class="prose max-w-none text-gray-700 leading-relaxed">
                {!! nl2br(e($blog->content)) !!}
            </div>
            
            {{-- Share --}}
            <div class="border-t border-gray-200 mt-12 pt-8">
                <p class="font-semibold text-gray-900 mb-4">Share this article:</p>
                <div class="flex gap-4">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($blog->title) }}" target="_blank" class="w-10 h-10 bg-blue-500 text-white rounded-full flex items-center justify-center hover:bg-blue-600 transition-all">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($blog->title) }}" target="_blank" class="w-10 h-10 bg-blue-700 text-white rounded-full flex items-center justify-center hover:bg-blue-800 transition-all">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════ RECENT POSTS ════════ --}}
@if($recent->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Recent Articles</h2 class="grid md:grid-cols>
        <div-3 gap-8">
            @foreach($recent as $post)
            <article class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all">
                <div class="h-40 overflow-hidden">
                    @if($post->image)
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-blog text-3xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <p class="text-sm text-blue-600 mb-1">{{ $post->display_date ?? $post->created_at->format('M d, Y') }}</p>
                    <h4 class="font-bold text-gray-900 mb-1">{{ $post->title }}</h4>
                    <a href="{{ route('blog.detail', $post->slug) }}" class="text-blue-600 text-sm">Read More</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
