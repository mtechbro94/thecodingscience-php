@extends('layouts.admin')

@section('title', $project ? 'Edit Project' : 'Add Project')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <a href="{{ route('admin.projects') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-1"></i>Back to Projects
        </a>
    </div>

    <h1 class="text-2xl font-bold mb-6">{{ $project ? 'Edit Project' : 'Add New Project' }}</h1>

    <form method="POST" action="{{ $project ? route('admin.projects.update', $project->id) : route('admin.projects.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if($project) @method('PUT') @endif

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" name="order" value="{{ old('order', $project->order ?? 0) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea name="description" rows="3" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $project->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <textarea name="content" rows="5"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('content', $project->content ?? '') }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    @if($project && $project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" class="mt-2 w-32 h-32 object-cover rounded">
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Technologies (comma separated)</label>
                    <input type="text" name="technologies" value="{{ old('technologies', $project->technologies ?? '') }}" placeholder="React, Node.js, MongoDB"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Client Name</label>
                    <input type="text" name="client_name" value="{{ old('client_name', $project->client_name ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Project URL</label>
                    <input type="url" name="project_url" value="{{ old('project_url', $project->project_url ?? '') }}" placeholder="https://"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" placeholder="https://github.com/..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            <div class="flex items-center gap-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
                        class="rounded text-primary-600 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-700">Featured Project</span>
                </label>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}
                        class="rounded text-primary-600 focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>
        </div>

        <button type="submit" class="px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="fas fa-save mr-2"></i>{{ $project ? 'Update Project' : 'Create Project' }}
        </button>
    </form>
</div>
@endsection
