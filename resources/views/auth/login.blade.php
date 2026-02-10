@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center py-16 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <div
                    class="w-14 h-14 mx-auto bg-gradient-to-br from-primary-500 to-accent-500 rounded-2xl flex items-center justify-center mb-4">
                    <span class="text-white font-bold text-2xl">T</span>
                </div>
                <h1 class="text-2xl font-bold">Welcome Back</h1>
                <p class="text-surface-500 text-sm mt-1">Sign in to continue learning</p>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                @if(session('status'))
                    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('status') }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required autofocus value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <label class="flex items-center gap-2"><input type="checkbox" name="remember" class="rounded">
                            Remember me</label>
                        <a href="{{ route('password.request') }}" class="text-primary-600 hover:underline">Forgot
                            password?</a>
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold rounded-xl hover:shadow-lg transition">
                        Sign In <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                </form>

                <p class="text-center text-sm text-surface-500 mt-6">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-primary-600 font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </section>
@endsection