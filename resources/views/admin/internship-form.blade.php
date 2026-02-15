@extends('layouts.admin')
@section('title', $internship ? 'Edit Role' : 'Add Role')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold">{{ $internship ? 'Edit' : 'Add New' }} Internship Role</h2>
            <a href="{{ route('admin.internships') }}" class="text-sm text-gray-500 hover:text-gray-700">Cancel</a>
        </div>

        <div class="bg-white rounded-xl border shadow-sm p-6">
            <form method="POST"
                action="{{ $internship ? route('admin.internships.update', $internship) : route('admin.internships.store') }}"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                @if($internship)
                    @method('POST') {{-- Using POST for both store and update to handle file uploads easily with some server configs, or I could use PUT but Laravel needs @method('PUT') --}}
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Role Title</label>
                        <input type="text" name="role" value="{{ old('role', $internship->role ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500" required
                            placeholder="e.g. Web Development Intern">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Company</label>
                        <input type="text" name="company" value="{{ old('company', $internship->company ?? 'School of Technology and AI Innovations') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Duration</label>
                        <input type="text" name="duration" value="{{ old('duration', $internship->duration ?? '3 Months') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Location</label>
                        <input type="text" name="location" value="{{ old('location', $internship->location ?? 'Remote') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Stipend (₹)</label>
                        <input type="number" name="stipend" value="{{ old('stipend', $internship->stipend ?? 999) }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500">{{ old('description', $internship->description ?? '') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Poster Image</label>
                    <input type="file" name="image"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500"
                        accept="image/*">
                    @if($internship && $internship->image)
                        <p class="text-xs text-gray-500 mt-1">Current: {{ basename($internship->image) }}</p>
                    @endif
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                        {{ old('is_active', $internship->is_active ?? true) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-600">Active and visible on website</label>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-2 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 transition">
                        {{ $internship ? 'Update Role' : 'Add Role' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
