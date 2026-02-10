@extends('layouts.app')
@section('title', $blog->title)
@section('meta_description', $blog->excerpt)

@section('content')
    <section class="max-w-4xl mx-auto px-4 py-12">
        <a href="{{ route('blog') }}"
            class="inline-flex items-center text-primary-600 hover:text-primary-700 mb-6 text-sm font-medium">
            <i class="fas fa-arrow-left mr-2"></i> Back to Blog
        </a>

        <article class="bg-white rounded-2xl p-8 sm:p-12 shadow-sm border border-surface-100">
            <div class="flex items-center gap-2 text-xs text-surface-400 mb-4">
                <span>{{ $blog->display_date ?? $blog->created_at->format('F d, Y') }}</span>
                <span>&bull;</span>
                <span>{{ $blog->author }}</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight mb-8">{{ $blog->title }}</h1>
            <div class="prose prose-lg max-w-none text-surface-700">{!! $blog->content !!}</div>
        </article>

        @if($recent->count())
            <div class="mt-12">
                <h3 class="text-xl font-bold mb-6">Related Articles</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recent as $r)
                        <a href="{{ route('blog.detail', $r) }}"
                            class="bg-white rounded-xl p-5 shadow-sm border border-surface-100 card-hover group">
                            <span class="text-xs text-surface-400">{{ $r->display_date ?? $r->created_at->format('M d, Y') }}</span>
                            <h4 class="font-bold mt-1 group-hover:text-primary-600 transition text-sm">{{ $r->title }}</h4>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection