@extends('layouts.app')

@section('title', 'Projects')

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">My Projects</h1>
        <p class="text-gray-400">Check out my recent work</p>
    </div>
</section>

{{-- ════════ PROJECTS ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        @if($projects->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all card-hover border border-gray-100">
                <div class="relative h-56 overflow-hidden">
                    @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform group-hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-5xl text-white/50"></i>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-4">
                        @if($project->project_url)
                        <a href="{{ $project->project_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 hover:bg-blue-600 hover:text-white transition-all">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                        @endif
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 hover:bg-gray-800 hover:text-white transition-all">
                            <i class="fab fa-github"></i>
                        </a>
                        @endif
                        <a href="{{ route('project.detail', $project->slug) }}" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-gray-900 hover:bg-blue-600 hover:text-white transition-all">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    @if($project->is_featured)
                    <span class="absolute top-4 right-4 px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                        <i class="fas fa-star mr-1"></i>Featured
                    </span>
                    @endif
                </div>
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $project->technologies) as $tech)
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <i class="fas fa-folder-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">No projects available yet.</p>
        </div>
        @endif
    </div>
</section>

{{-- ════════ CTA ════════ --}}
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Have a Project in Mind?</h2>
        <p class="text-gray-600 mb-8">Let's create something amazing together.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
            <i class="fas fa-envelope mr-2"></i>Let's Talk
        </a>
    </div>
</section>
@endsection
