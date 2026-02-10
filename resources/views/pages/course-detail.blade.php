@extends('layouts.app')
@section('title', $course->name)
@section('meta_description', $course->summary)

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <a href="{{ route('courses') }}"
                class="inline-flex items-center text-primary-200 hover:text-white mb-4 transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i> All Courses
            </a>
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                <div class="flex-1">
                    <span class="px-3 py-1 bg-white/15 rounded-full text-sm font-medium">{{ $course->level }}</span>
                    <h1 class="text-3xl sm:text-4xl font-extrabold mt-4">{{ $course->name }}</h1>
                    <div class="flex items-center gap-4 mt-4 text-primary-200 text-sm">
                        <span><i class="fas fa-clock mr-1"></i> {{ $course->duration }}</span>
                        @if($avgRating > 0)
                            <span><i class="fas fa-star mr-1 text-yellow-400"></i> {{ $avgRating }} ({{ $reviews->count() }}
                                reviews)</span>
                        @endif
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur rounded-2xl p-6 text-center min-w-[200px]">
                    <div class="text-3xl font-extrabold">₹{{ number_format($course->price) }}</div>
                    <p class="text-primary-200 text-sm mt-1">One-time payment</p>
                    @auth
                        @if($isEnrolled)
                            <span class="mt-4 inline-block px-6 py-2 bg-green-500 text-white rounded-lg font-medium"><i
                                    class="fas fa-check mr-1"></i> Enrolled</span>
                        @else
                            <a href="{{ route('enroll', $course) }}"
                                class="mt-4 inline-block px-6 py-2 bg-white text-primary-600 rounded-lg font-bold hover:shadow-lg transition">Enroll
                                Now</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="mt-4 inline-block px-6 py-2 bg-white text-primary-600 rounded-lg font-bold hover:shadow-lg transition">Login
                            to Enroll</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid lg:grid-cols-3 gap-10">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-10">
                {{-- Description --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                    <h2 class="text-2xl font-bold mb-4">Course Overview</h2>
                    <div class="text-surface-600 leading-relaxed prose max-w-none">{!! $course->description !!}</div>
                </div>

                {{-- Curriculum --}}
                @if($course->curriculum && count($course->curriculum))
                    <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                        <h2 class="text-2xl font-bold mb-6">Curriculum</h2>
                        <div class="space-y-3">
                            @foreach($course->curriculum as $idx => $module)
                                <div class="flex items-start gap-4 p-4 bg-surface-50 rounded-xl">
                                    <div
                                        class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center text-sm font-bold flex-shrink-0">
                                        {{ $idx + 1 }}</div>
                                    <span class="text-surface-700">{{ $module }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Reviews --}}
                <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                    <h2 class="text-2xl font-bold mb-6">Student Reviews</h2>
                    @forelse($reviews as $review)
                        <div class="border-b border-surface-100 last:border-0 pb-4 mb-4 last:pb-0 last:mb-0">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 bg-primary-100 text-primary-600 rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr($review->user->name, 0, 1)) }}</div>
                                <div>
                                    <span class="font-semibold text-sm">{{ $review->user->name }}</span>
                                    <div class="text-yellow-500 text-xs">@for($i = 0; $i < $review->rating; $i++)<i
                                    class="fas fa-star"></i>@endfor</div>
                                </div>
                            </div>
                            @if($review->review_text)
                                <p class="text-surface-600 text-sm mt-2">{{ $review->review_text }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-surface-400 text-sm">No reviews yet. Be the first to review this course!</p>
                    @endforelse

                    {{-- Add Review --}}
                    @auth
                        @if($isEnrolled)
                            <form method="POST" action="{{ route('review.store', $course) }}"
                                class="mt-6 pt-6 border-t border-surface-100">
                                @csrf
                                <h3 class="font-semibold mb-3">Write a Review</h3>
                                <div class="flex items-center gap-1 mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer"><input type="radio" name="rating" value="{{ $i }}"
                                                class="hidden peer" {{ $i == 5 ? 'checked' : '' }}><i
                                                class="fas fa-star text-xl text-surface-300 peer-checked:text-yellow-500"></i></label>
                                    @endfor
                                </div>
                                <textarea name="review_text" rows="3" placeholder="Share your experience..."
                                    class="w-full p-3 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent text-sm"></textarea>
                                <button type="submit"
                                    class="mt-3 px-5 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium hover:bg-primary-700 transition">Submit
                                    Review</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100 sticky top-20">
                    <h3 class="font-bold text-lg mb-4">Course Info</h3>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-3"><i
                                class="fas fa-clock text-primary-500 w-5"></i><span><strong>Duration:</strong>
                                {{ $course->duration }}</span></li>
                        <li class="flex items-center gap-3"><i
                                class="fas fa-signal text-primary-500 w-5"></i><span><strong>Level:</strong>
                                {{ $course->level }}</span></li>
                        <li class="flex items-center gap-3"><i
                                class="fas fa-tag text-primary-500 w-5"></i><span><strong>Price:</strong>
                                ₹{{ number_format($course->price) }}</span></li>
                        @if($course->trainer)
                            <li class="flex items-center gap-3"><i
                                    class="fas fa-user text-primary-500 w-5"></i><span><strong>Trainer:</strong>
                                    {{ $course->trainer->name }}</span></li>
                        @endif
                        <li class="flex items-center gap-3"><i
                                class="fas fa-certificate text-primary-500 w-5"></i><span><strong>Certificate:</strong>
                                Yes</span></li>
                        <li class="flex items-center gap-3"><i
                                class="fas fa-headset text-primary-500 w-5"></i><span><strong>Support:</strong> WhatsApp
                                Group</span></li>
                    </ul>
                    @auth
                        @if(!$isEnrolled)
                            <a href="{{ route('enroll', $course) }}"
                                class="mt-6 block text-center px-6 py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-bold rounded-xl hover:shadow-lg transition">Enroll
                                Now</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="mt-6 block text-center px-6 py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-bold rounded-xl hover:shadow-lg transition">Login
                            to Enroll</a>
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection