@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .hero-gradient {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
    }
    
    .blob {
        position: absolute;
        filter: blur(80px);
        opacity: 0.5;
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
    }
</style>
@endpush

@section('content')
{{-- ════════ HERO SECTION ════════ --}}
<section class="hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
    {{-- Animated Blobs --}}
    <div class="blob w-96 h-96 bg-purple-600 rounded-full top-20 left-10"></div>
    <div class="blob w-80 h-80 bg-blue-600 rounded-full bottom-20 right-10 animation-delay-2000"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Hero Content --}}
            <div class="text-center lg:text-left animate-fade-in">
                <p class="text-blue-400 font-medium mb-4">{{ $hero?->subtitle ?? 'Welcome to' }}</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $hero?->title ?? 'AI & Data Science Trainer | Educator' }}
                </h1>
                <p class="text-gray-300 text-lg mb-8 max-w-xl">
                    {{ $hero?->description ?? 'I help students, professionals, and organizations build real-world skills in Data Science, Artificial Intelligence, and modern software technologies.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ $hero?->cta_link ?? route('services') }}" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all transform hover:scale-105">
                        <i class="fas fa-graduation-cap mr-2"></i>{{ $hero?->cta_text ?? 'View Programs' }}
                    </a>
                    <a href="{{ $hero?->cta2_link ?? route('projects') }}" class="px-8 py-4 border-2 border-white/30 hover:border-white/60 text-white font-semibold rounded-lg transition-all">
                        <i class="fas fa-briefcase mr-2"></i>{{ $hero?->cta2_text ?? 'Explore Projects' }}
                    </a>
                    <a href="{{ route('contact') }}" class="px-8 py-4 border-2 border-white/30 hover:border-white/60 text-white font-semibold rounded-lg transition-all">
                        <i class="fas fa-envelope mr-2"></i>Work With Me
                    </a>
                </div>
                
                {{-- Social Links --}}
                <div class="mt-10 flex gap-4 justify-center lg:justify-start">
                    @forelse($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-all">
                        <i class="{{ $link->icon }}"></i>
                    </a>
                    @empty
                    @endforelse
                </div>
            </div>
            
            {{-- Hero Image --}}
            <div class="relative hidden lg:block">
                <div class="relative w-full max-w-md mx-auto">
                    @if($hero && $hero->image)
                    <img src="{{ asset('storage/' . $hero->image) }}" alt="Hero" class="rounded-2xl shadow-2xl">
                    @else
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl p-8 shadow-2xl">
                        <div class="text-white text-center">
                            <i class="fas fa-robot text-8xl mb-4"></i>
                            <p class="text-xl font-semibold">AI & Machine Learning</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    {{-- Scroll Down Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#about" class="text-white/60 hover:text-white">
            <i class="fas fa-chevron-down text-2xl"></i>
        </a>
    </div>
</section>

{{-- ════════ ABOUT SECTION ════════ --}}
<section id="about" class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="relative">
                @if($about && $about->image)
                <img src="{{ asset('storage/' . $about->image) }}" alt="About" class="rounded-2xl shadow-xl">
                @else
                <div class="bg-gradient-to-br from-blue-100 to-purple-100 rounded-2xl p-12 text-center">
                    <i class="fas fa-user text-8xl text-blue-600"></i>
                </div>
                @endif
                <div class="absolute -bottom-6 -right-6 bg-blue-600 text-white px-6 py-4 rounded-xl shadow-lg">
                    <p class="font-bold text-2xl">5+</p>
                    <p class="text-sm">Years Experience</p>
                </div>
            </div>
            
            <div>
                <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">About Me</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">
                    {{ $about?->title ?? 'Passionate Developer & AI Enthusiast' }}
                </h3>
                <div class="text-gray-600 mb-6 prose">
                    {!! $about?->content ?? '<p>I am a passionate developer with expertise in AI, Machine Learning, and Web Development. I love sharing knowledge through my blog and helping others learn.</p>' !!}
                </div>
                
                @if($about && $about->skills)
                <div class="mb-8">
                    <h4 class="font-semibold text-gray-900 mb-4">Expertise & Skills</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($about->skills as $skill)
                        <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-full text-sm font-medium">{{ $skill }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($about && $about->resume_url)
                <a href="{{ $about->resume_url }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                    <i class="fas fa-download mr-2"></i>Download Resume
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ════════ SERVICES SECTION ════════ --}}
@if($services && $services->count() > 0)
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">What I Do</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Training & Services</h3>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all card-hover">
                <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center mb-6">
                    <i class="{{ $service->icon ?? 'fas fa-code' }} text-2xl text-blue-600"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h4>
                <p class="text-gray-600 mb-4">{{ $service->description }}</p>
                <a href="{{ route('service.detail', $service->slug) }}" class="text-blue-600 font-semibold hover:text-blue-700">
                    Learn More <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                View All Services <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ════════ PROJECTS SECTION ════════ --}}
@if($featuredProjects && $featuredProjects->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">Portfolio</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Featured Projects</h3>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProjects as $project)
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all card-hover">
                <div class="relative h-48 overflow-hidden">
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
                    </div>
                </div>
                <div class="p-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $project->title }}</h4>
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
        
        <div class="text-center mt-12">
            <a href="{{ route('projects') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                View All Projects <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ════════ TESTIMONIALS SECTION ════════ --}}
@if($testimonials && $testimonials->count() > 0)
<section class="py-20 bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-sm font-semibold text-blue-400 uppercase tracking-wider mb-2">Testimonials</h2>
            <h3 class="text-3xl md:text-4xl font-bold">What People Say</h3>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10">
                <div class="flex items-center gap-1 mb-4 text-yellow-400">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <i class="fas fa-star"></i>
                    @endfor
                </div>
                <p class="text-gray-300 mb-6 italic">"{{ $testimonial->message }}"</p>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center font-bold">
                        {{ substr($testimonial->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-semibold">{{ $testimonial->name }}</p>
                        @if($testimonial->designation)
                        <p class="text-sm text-gray-400">{{ $testimonial->designation }}@if($testimonial->company), {{ $testimonial->company }}@endif</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ════════ BLOG PREVIEW SECTION ════════ --}}
@if($blogs && $blogs->count() > 0)
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-sm font-semibold text-blue-600 uppercase tracking-wider mb-2">Blog</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-gray-900">Latest Articles</h3>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($blogs as $blog)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all card-hover">
                <div class="h-48 overflow-hidden">
                    @if($blog->image)
                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="w-full h-full object-cover transition-transform hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <i class="fas fa-blog text-5xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6">
                    <p class="text-sm text-blue-600 mb-2">{{ $blog->display_date ?? $blog->created_at->format('M d, Y') }}</p>
                    <h4 class="text-lg font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                        <a href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                    </h4>
                    <p class="text-gray-600 text-sm line-clamp-2">{{ $blog->excerpt }}</p>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('blog') }}" class="inline-flex items-center px-6 py-3 border-2 border-blue-600 text-blue-600 font-semibold rounded-lg hover:bg-blue-600 hover:text-white transition-all">
                View All Posts <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ════════ CONTACT CTA SECTION ════════ --}}
<section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Let's Work Together</h2>
        <p class="text-white/80 text-lg mb-8 max-w-2xl mx-auto">
            Have a project in mind or want to collaborate? Feel free to reach out!
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-all transform hover:scale-105">
            <i class="fas fa-envelope mr-2"></i>Get In Touch
        </a>
    </div>
</section>
@endsection
