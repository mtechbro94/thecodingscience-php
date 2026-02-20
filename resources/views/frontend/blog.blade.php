@extends('layouts.app')

@section('title', 'Blog')

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Blog</h1>
        <p class="text-gray-400">Latest articles and tutorials</p>
    </div>
</section>

{{-- ════════ BLOG POSTS ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($blogs->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all card-hover border border-gray-100">
                <div class="h-56 overflow-hidden">
                    @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-blog text-5xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-sm text-blue-600 mb-2">{{ $blog->display_date ?? $blog->created_at->format('M d, Y') }}</p>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                        <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                    </h3>
                    <p class="text-gray-600 text-sm line-clamp-2 mb-4">{{ $blog->excerpt }}</p>
                    <a href="{{ route('blog.detail', $blog->slug) }}" class="text-blue-600 font-semibold text-sm hover:text-blue-700">
                        Read More <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        <div class="mt-12">
            {{ $blogs->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-pen-fancy text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No blog posts available yet.</p>
            <p class="text-gray-400">Check back soon for new content!</p>
        </div>
        @endif
    </div>
</section>

{{-- ════════ NEWSLETTER ════════ --}}
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Subscribe to Newsletter</h2>
        <p class="text-white/80 mb-8">Get the latest articles and updates delivered to your inbox.</p>
        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="max-w-md mx-auto flex gap-4">
            @csrf
            <input type="email" name="email" placeholder="Enter your email" required
                class="flex-1 px-6 py-4 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-white">
            <button type="submit" class="px-8 py-4 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all">
                Subscribe
            </button>
        </form>
    </div>
</section>
@endsection
