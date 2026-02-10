@extends('layouts.app')
@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with The Coding Science. We\'d love to hear from you.')

@section('content')
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl sm:text-5xl font-extrabold">Contact <span class="text-primary-200">Us</span></h1>
            <p class="mt-4 text-lg text-primary-100">Have questions? We'd love to hear from you.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid lg:grid-cols-3 gap-10">
            {{-- Contact Info --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center"><i
                                class="fas fa-envelope text-primary-600"></i></div>
                        <div>
                            <p class="text-sm text-surface-400">Email</p>
                            <p class="font-medium">academy@thecodingscience.com</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center"><i
                                class="fas fa-phone text-primary-600"></i></div>
                        <div>
                            <p class="text-sm text-surface-400">Phone</p>
                            <p class="font-medium">+91 7006196821</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-surface-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center"><i
                                class="fas fa-map-marker-alt text-primary-600"></i></div>
                        <div>
                            <p class="text-sm text-surface-400">Location</p>
                            <p class="font-medium">India (Remote)</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                <h2 class="text-2xl font-bold mb-6">Send us a Message</h2>
                <form method="POST" action="{{ route('contact.submit') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">Name *</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ old('name') }}">
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Email *</label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ old('email') }}">
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium mb-1">Phone</label>
                            <input type="tel" name="phone"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ old('phone') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Subject</label>
                            <input type="text" name="subject"
                                class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm"
                                value="{{ old('subject') }}">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Message *</label>
                        <textarea name="message" required rows="5"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit"
                        class="px-8 py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold rounded-xl hover:shadow-lg transition">
                        Send Message <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection