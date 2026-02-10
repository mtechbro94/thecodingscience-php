@extends('layouts.admin')
@section('title', $blog ? 'Edit Blog' : 'New Blog Post')

@section('content')
    <div class="max-w-3xl">
        <a href="{{ route('admin.blogs') }}" class="text-primary-600 text-sm hover:underline mb-4 inline-block"><i
                class="fas fa-arrow-left mr-1"></i>Back</a>
        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <form method="POST" action="{{ $blog ? route('admin.blogs.update', $blog) : route('admin.blogs.store') }}"
                class="space-y-4">
                @csrf
                @if($blog) @method('PUT') @endif
                <div><label class="block text-sm font-medium mb-1">Title *</label><input type="text" name="title" required
                        value="{{ old('title', $blog->title ?? '') }}"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500"></div>
                <div><label class="block text-sm font-medium mb-1">Excerpt *</label><textarea name="excerpt" rows="2"
                        required
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500">{{ old('excerpt', $blog->excerpt ?? '') }}</textarea>
                </div>
                <div><label class="block text-sm font-medium mb-1">Content *</label><textarea name="content" rows="15"
                        required
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500 font-mono">{{ old('content', $blog->content ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium mb-1">Author *</label><input type="text" name="author"
                            required value="{{ old('author', $blog->author ?? auth()->user()->name) }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm"></div>
                    <div><label class="block text-sm font-medium mb-1">Display Date</label><input type="text"
                            name="display_date" value="{{ old('display_date', $blog->display_date ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="Jan 01, 2026"></div>
                </div>
                <div><label class="block text-sm font-medium mb-1">Image Filename</label><input type="text" name="image"
                        value="{{ old('image', $blog->image ?? '') }}" class="w-full px-3 py-2 border rounded-lg text-sm"
                        placeholder="blog-image.jpg"></div>
                <div class="flex items-center gap-2"><input type="checkbox" name="is_published" value="1" id="is_published"
                        {{ old('is_published', $blog->is_published ?? true) ? 'checked' : '' }} class="rounded"><label
                        for="is_published" class="text-sm">Published</label></div>
                <button type="submit"
                    class="px-6 py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition">{{ $blog ? 'Update Post' : 'Publish Post' }}</button>
            </form>
        </div>
    </div>
@endsection