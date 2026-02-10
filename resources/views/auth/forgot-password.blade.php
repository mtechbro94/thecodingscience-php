@extends('layouts.app')
@section('title', 'Forgot Password')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center py-16 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">Forgot Password?</h1>
                <p class="text-surface-500 text-sm mt-1">Enter your email and we'll send you a reset link.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                @if(session('status'))
                    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">{{ session('status') }}</div>
                @endif
                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">
                        Send Reset Link
                    </button>
                </form>
                <p class="text-center text-sm text-surface-500 mt-6"><a href="{{ route('login') }}"
                        class="text-primary-600 font-semibold hover:underline">Back to Login</a></p>
            </div>
        </div>
    </section>
@endsection