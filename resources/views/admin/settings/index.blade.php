@extends('layouts.admin')
@section('title', 'Site Settings')

@section('content')
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h2 class="text-xl font-bold mb-6">Site Configuration</h2>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @foreach($settings as $group => $groupSettings)
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-primary-600 mb-4 capitalize border-b pb-2">{{ $group }} Settings</h3>
                    <div class="grid grid-cols-1 gap-6">
                        @foreach($groupSettings as $setting)
                            <div>
                                <label for="{{ $setting->key }}"
                                    class="block text-sm font-medium text-gray-700 mb-1">{{ $setting->label ?? $setting->key }}</label>

                                @if($setting->type === 'text')
                                    <input type="text" name="{{ $setting->key }}" id="{{ $setting->key }}" value="{{ $setting->value }}"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">

                                @elseif($setting->type === 'textarea')
                                    <textarea name="{{ $setting->key }}" id="{{ $setting->key }}" rows="3"
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">{{ $setting->value }}</textarea>

                                @elseif($setting->type === 'image')
                                    <div class="flex items-center gap-4">
                                        @if($setting->value)
                                            <img src="{{ asset('storage/' . $setting->value) }}" alt="Current Image"
                                                class="h-16 w-16 object-cover rounded border">
                                        @endif
                                        <input type="file" name="{{ $setting->key }}" id="{{ $setting->key }}"
                                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">Save
                    Changes</button>
            </div>
        </form>
    </div>
@endsection