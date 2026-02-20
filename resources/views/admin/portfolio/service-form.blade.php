@extends('layouts.admin')

@section('title', $service ? 'Edit Service' : 'Add Service')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.services') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-1"></i>Back to Services
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">{{ $service ? 'Edit Service' : 'Add New Service' }}</h1>

    <form method="POST" action="{{ $service ? route('admin.services.update', $service->id) : route('admin.services.store') }}" class="space-y-6">
        @csrf
        @if($service) @method('PUT') @endif

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $service->title ?? '') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon (Font Awesome class)</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon ?? 'fas fa-code') }}" placeholder="fas fa-code"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    <p class="text-xs text-gray-500 mt-1">Use Font Awesome classes like: fas fa-code, fab fa-react, etc.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea name="description" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">{{ old('description', $service->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content (What's Included)</label>
                <textarea name="content" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">{{ old('content', $service->content ?? '') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" value="{{ old('order', $service->order ?? 0) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <div class="flex items-center pt-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active ?? true) ? 'checked' : '' }}
                            class="rounded text-primary-600 focus:ring-primary-500">
                        <span class="ml-2 text-sm text-gray-700">Active</span>
                    </label>
                </div>
            </div>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>{{ $service ? 'Update Service' : 'Create Service' }}
        </button>
    </form>
</div>
@endsection
