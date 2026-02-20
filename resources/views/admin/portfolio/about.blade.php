@extends('layouts.admin')

@section('title', 'About Section')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">About Section Settings</h1>

    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $about->title ?? 'About Me') }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="About Me">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" rows="8"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="Tell us about yourself...">{{ old('content', $about->content ?? '') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                    <input type="file" name="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="mt-2 w-48 h-48 object-cover rounded-lg">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Resume URL</label>
                    <input type="url" name="resume_url" value="{{ old('resume_url', $about->resume_url ?? '') }}" placeholder="https://drive.google.com/..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500">
                    <p class="text-xs text-gray-500 mt-1">Link to your resume (Google Drive, Dropbox, etc.)</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Skills (comma separated)</label>
                <input type="text" name="skills" value="{{ old('skills', $about && $about->skills ? implode(',', $about->skills) : '') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500"
                    placeholder="Python, JavaScript, React, Machine Learning, AI">
                <p class="text-xs text-gray-500 mt-1">Separate skills with commas</p>
            </div>

            <label class="flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $about->is_active ?? true) ? 'checked' : '' }}
                    class="rounded text-primary-600 focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-700">About Section Active</span>
            </label>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>Save About Section
        </button>
    </form>
</div>
@endsection
