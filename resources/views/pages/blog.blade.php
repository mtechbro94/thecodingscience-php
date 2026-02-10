@extends('layouts.app')
@section('title', 'Blog')
@section('meta_description', 'Read the latest tech articles, tutorials, and insights from The Coding Science.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">Our <span class="text-primary-200">Blog</span></h1>
            <p class="mt-4 text-lg text-primary-100">Tech articles, tutorials, and industry insights.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
                <a href="{{ route('blog.detail', $blog) }}"
                    class="bg-white rounded-2xl shadow-sm border border-surface-100 overflow-hidden card-hover group">
                    <div class="h-48 bg-gradient-to-br from-primary-50 to-accent-50 flex items-center justify-center">
                        <i class="fas fa-newspaper text-4xl text-primary-300 group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 text-xs text-surface-400 mb-2">
                            <span>{{ $blog->display_date ?? $blog->created_at->format('M d, Y') }}</span>
                            <span>&bull;</span>
                            <span>{{ $blog->author }}</span>
                        </div>
                        <h3 class="text-lg font-bold group-hover:text-primary-600 transition">{{ $blog->title }}</h3>
                        <p class="text-surface-500 text-sm mt-2 line-clamp-3">{{ $blog->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-10">{{ $blogs->links() }}</div>
    </section>
@endsection