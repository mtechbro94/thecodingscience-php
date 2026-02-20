@extends('layouts.admin')

@section('title', 'Hero Section')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Hero Section Settings</h1>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.hero.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="Hi, I'm Mir - AI & ML Enthusiast">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $hero->subtitle ?? '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="Welcome to">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="Explore the world of AI...">{{ old('description', $hero->description ?? '') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @if($hero && $hero->image)
                    <img src="{{ asset('storage/' . $hero->image) }}" class="mt-2 w-48 h-48 object-cover rounded-lg">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CTA Button 1 Text</label>
                    <input type="text" name="cta_text" value="{{ old('cta_text', $hero->cta_text ?? 'View Projects') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    
                    <label class="block text-sm font-medium text-gray-700 mb-2 mt-4">CTA Button 1 Link</label>
                    <input type="text" name="cta_link" value="{{ old('cta_link', $hero->cta_link ?? '/projects') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CTA Button 2 Text</label>
                    <input type="text" name="cta2_text" value="{{ old('cta2_text', $hero->cta2_text ?? 'Contact Me') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">CTA Button 2 Link</label>
                    <input type="text" name="cta2_link" value="{{ old('cta2_link', $hero->cta2_link ?? '/contact') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }}
                    class="rounded text-primary-600 focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-700">Hero Section Active</span>
            </label>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>Save Hero Section
        </button>
    </form>
</div>
@endsection
