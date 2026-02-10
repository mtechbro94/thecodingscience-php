@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center py-16 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div
                    class="w-14 h-14 mx-auto bg-gradient-to-br from-primary-500 to-accent-500 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-white font-bold text-2xl">T</span>
                </div>
                <h1 class="text-2xl font-bold">Create Account</h1>
                <p class="text-surface-500 text-sm mt-1">Start your learning journey today</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Full Name</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Phone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-2">Register as</label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="role" value="student" checked class="hidden peer">
                                <div
                                    class="p-3 border-2 border-surface-200 rounded-lg text-center text-sm peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                    <i class="fas fa-graduation-cap text-lg"></i><br>Student
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="role" value="trainer" class="hidden peer">
                                <div
                                    class="p-3 border-2 border-surface-200 rounded-lg text-center text-sm peer-checked:border-primary-500 peer-checked:bg-primary-50 transition">
                                    <i class="fas fa-chalkboard-teacher text-lg"></i><br>Trainer
                                </div>
                            </label>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold rounded-xl hover:shadow-lg transition">
                        Create Account <i class="fas fa-rocket ml-2"></i>
                    </button>
                </form>
                <p class="text-center text-sm text-surface-500 mt-6">
                    Already have an account? <a href="{{ route('login') }}"
                        class="text-primary-600 font-semibold hover:underline">Sign In</a>
                </p>
            </div>
        </div>
    </section>
@endsection