@extends('layouts.app')
@section('title', 'Reset Password')

@section('content')
    <section class="min-h-[80vh] flex items-center justify-center py-16 px-4">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold">Reset Password</h1>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100">
                <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" name="email" required value="{{ old('email', $request->email) }}"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">New Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-700 transition">Reset
                        Password</button>
                </form>
            </div>
        </div>
    </section>
@endsection