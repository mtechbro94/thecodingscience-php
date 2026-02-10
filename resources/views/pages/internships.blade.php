@extends('layouts.app')
@section('title', 'Internships')
@section('meta_description', 'Apply for remote internship opportunities in Web Development, Python, and Data Science.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">Internship <span class="text-primary-200">Opportunities</span>
            </h1>
            <p class="mt-4 text-lg text-primary-100 max-w-xl mx-auto">Gain real-world experience with our remote internship
                programs.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($internships as $intern)
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100 card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full">Open</span>
                        <span class="text-primary-600 font-bold">₹{{ number_format($intern['stipend']) }}</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">{{ $intern['role'] }}</h3>
                    <p class="text-surface-500 text-sm mb-1"><i
                            class="fas fa-building mr-2 text-primary-400"></i>{{ $intern['company'] }}</p>
                    <div class="flex items-center gap-4 text-sm text-surface-400 mb-4">
                        <span><i class="fas fa-clock mr-1"></i>{{ $intern['duration'] }}</span>
                        <span><i class="fas fa-map-marker-alt mr-1"></i>{{ $intern['location'] }}</span>
                    </div>
                    <p class="text-surface-600 text-sm leading-relaxed mb-6">{{ $intern['description'] }}</p>

                    <button onclick="document.getElementById('applyModal{{ $intern['id'] }}').classList.remove('hidden')"
                        class="w-full py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition text-sm">
                        Apply Now <i class="fas fa-arrow-right ml-1"></i>
                    </button>
                </div>

                {{-- Apply Modal --}}
                <div id="applyModal{{ $intern['id'] }}"
                    class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
                    <div class="bg-white rounded-2xl p-8 max-w-md w-full relative">
                        <button onclick="this.closest('[id^=applyModal]').classList.add('hidden')"
                            class="absolute top-4 right-4 text-surface-400 hover:text-surface-600"><i
                                class="fas fa-times"></i></button>
                        <h3 class="text-xl font-bold mb-4">Apply for {{ $intern['role'] }}</h3>
                        <form method="POST" action="{{ route('internship.apply') }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="internship_id" value="{{ $intern['id'] }}">
                            <input type="hidden" name="internship_role" value="{{ $intern['role'] }}">
                            <input type="text" name="name" required placeholder="Full Name"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ auth()->user()->name ?? '' }}">
                            <input type="email" name="email" required placeholder="Email"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ auth()->user()->email ?? '' }}">
                            <input type="tel" name="phone" required placeholder="Phone"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ auth()->user()->phone ?? '' }}">
                            <textarea name="cover_letter" rows="3" placeholder="Why should we select you?"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"></textarea>
                            <button type="submit"
                                class="w-full py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition text-sm">Submit
                                Application</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection