@extends('layouts.admin')

@section('title', $testimonial ? 'Edit Testimonial' : 'Add Testimonial')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.testimonials') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-1"></i>Back to Testimonials
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">{{ $testimonial ? 'Edit Testimonial' : 'Add New Testimonial' }}</h1>

    <form method="POST" action="{{ $testimonial ? route('admin.testimonials.update', $testimonial->id) : route('admin.testimonials.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($testimonial) @method('PUT') @endif

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name ?? '') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                    <select name="rating" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                        @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating ?? 5) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Designation</label>
                    <input type="text" name="designation" value="{{ old('designation', $testimonial->designation ?? '') }}" placeholder="CEO, Developer, etc."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                    <input type="text" name="company" value="{{ old('company', $testimonial->company ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">{{ old('message', $testimonial->message ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @if($testimonial && $testimonial->image)
                <img src="{{ asset('storage/' . $testimonial->image) }}" class="mt-2 w-20 h-20 object-cover rounded-full">
                @endif
            </div>

            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                    class="rounded text-primary-600 focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-700">Active</span>
            </label>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>{{ $testimonial ? 'Update' : 'Create' }}
        </button>
    </form>
</div>
@endsection
