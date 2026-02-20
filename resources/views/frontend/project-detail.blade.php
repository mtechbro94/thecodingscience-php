@extends('layouts.app')

@section('title', $project->title)

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $project->title }}</h1>
        <p class="text-gray-400">Project Details</p>
    </div>
</section>

{{-- ════════ PROJECT DETAIL ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                {{-- Project Image --}}
                <div class="rounded-2xl overflow-hidden mb-8">
                    @if($project->image)
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full">
                    @else
                    <div class="w-full h-96 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-8xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                
                {{-- Project Content --}}
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Project</h2>
                <div class="text-gray-600 prose max-w-none mb-8">
                    {!! nl2br(e($project->description)) !!}
                </div>
                
                @if($project->content)
                <div class="bg-gray-50 rounded-2xl p-8 mb-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Technical Details</h3>
                    <div class="text-gray-600 prose max-w-none">
                        {!! nl2br(e($project->content)) !!}
                    </div>
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <div>
                <div class="bg-gray-50 rounded-2xl p-8 sticky top-24">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Project Details</h3>
                    
                    @if($project->client_name)
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-1">Client</p>
                        <p class="font-semibold">{{ $project->client_name }}</p>
                    </div>
                    @endif
                    
                    @if($project->technologies)
                    <div class="mb-6">
                        <p class="text-sm text-gray-500 mb-2">Technologies</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->technologies) as $tech)
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <p class="text-sm text-gray-500 mb-4">Links</p>
                        <div class="space-y-3">
                            @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="flex items-center gap-3 text-blue-600 hover:text-blue-700">
                                <i class="fas fa-external-link-alt"></i>
                                <span>Live Demo</span>
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="flex items-center gap-3 text-gray-900 hover:text-blue-600">
                                <i class="fab fa-github"></i>
                                <span>Source Code</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <a href="{{ route('contact') }}" class="block w-full text-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                            <i class="fas fa-envelope mr-2"></i>Start Similar Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════ RELATED PROJECTS ════════ --}}
@if($relatedProjects->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Projects</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($relatedProjects as $related)
            <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all">
                <div class="h-40 overflow-hidden">
                    @if($related->image)
                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-4xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-gray-900 mb-1">{{ $related->title }}</h4>
                    <a href="{{ route('project.detail', $related->slug) }}" class="text-blue-600 text-sm">View Details</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
