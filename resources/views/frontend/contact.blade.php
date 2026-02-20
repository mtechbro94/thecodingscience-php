@extends('layouts.app')

@section('title', 'Contact')

@section('content')
{{-- ════════ PAGE HEADER ════════ --}}
<section class="bg-gray-900 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Get In Touch</h1>
        <p class="text-gray-400">Have a question or want to work together?</p>
    </div>
</section>

{{-- ════════ CONTACT ════════ --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Contact Form --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send a Message</h2>
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="Your name">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                                placeholder="your@email.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone (Optional)</label>
                        <input type="tel" name="phone"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="+91 9876543210">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject (Optional)</label>
                        <input type="text" name="subject"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="What's this about?">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                        <textarea name="message" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                            placeholder="Tell me about your project..."></textarea>
                    </div>
                    <button type="submit" class="w-full px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                        <i class="fas fa-paper-plane mr-2"></i>Send Message
                    </button>
                </form>
            </div>
            
            {{-- Contact Info --}}
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact Information</h2>
                
                @if($about && $about->content)
                <div class="bg-gray-50 rounded-2xl p-8 mb-8">
                    <h3 class="font-bold text-gray-900 mb-4">About Me</h3>
                    <p class="text-gray-600">{{ Str::limit(strip_tags($about->content), 300) }}</p>
                </div>
                @endif
                
                <div class="space-y-6">
                    @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="{{ $link->icon }} text-blue-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ ucfirst($link->platform) }}</p>
                            <p class="text-sm text-gray-500">{{ $link->url }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                
                {{-- Quick Response Times --}}
                <div class="mt-8 p-6 bg-blue-50 rounded-2xl">
                    <h3 class="font-bold text-gray-900 mb-4">Response Time</h3>
                    <div class="flex items-center gap-4 text-gray-600">
                        <i class="fas fa-clock text-blue-600 text-xl"></i>
                        <p>I typically respond within 24-48 hours</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
