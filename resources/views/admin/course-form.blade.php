@extends('layouts.admin')
@section('title', $course ? 'Edit Course' : 'Add Course')

@section('content')
    <div class="max-w-2xl">
        <a href="{{ route('admin.courses') }}" class="text-primary-600 text-sm hover:underline mb-4 inline-block"><i
                class="fas fa-arrow-left mr-1"></i>Back</a>

        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <form method="POST"
                action="{{ $course ? route('admin.courses.update', $course) : route('admin.courses.store') }}"
                enctype="multipart/form-data" class="space-y-4">
                @csrf
                @if($course) @method('PUT') @endif

                <div><label class="block text-sm font-medium mb-1">Course Name *</label><input type="text" name="name"
                        required value="{{ old('name', $course->name ?? '') }}"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500">@error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div><label class="block text-sm font-medium mb-1">Summary</label><input type="text" name="summary"
                        value="{{ old('summary', $course->summary ?? '') }}"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500"
                        maxlength="300"></div>
                <div><label class="block text-sm font-medium mb-1">Description</label><textarea name="description" rows="5"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500">{{ old('description', $course->description ?? '') }}</textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium mb-1">Level</label><select name="level"
                            class="w-full px-3 py-2 border rounded-lg text-sm">
                            <option value="Beginner" {{ old('level', $course->level ?? '') == 'Beginner' ? 'selected' : '' }}>
                                Beginner</option>
                            <option value="Intermediate" {{ old('level', $course->level ?? '') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="Advanced" {{ old('level', $course->level ?? '') == 'Advanced' ? 'selected' : '' }}>
                                Advanced</option>
                        </select></div>
                    <div><label class="block text-sm font-medium mb-1">Duration</label><input type="text" name="duration"
                            value="{{ old('duration', $course->duration ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm" placeholder="e.g. 3 Months"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-medium mb-1">Price (₹) *</label><input type="number" name="price"
                            required value="{{ old('price', $course->price ?? '') }}"
                            class="w-full px-3 py-2 border rounded-lg text-sm" min="0" step="0.01"></div>
                    <div><label class="block text-sm font-medium mb-1">Course Image</label><input type="file" name="image"
                            class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-primary-500"
                            accept="image/*">
                        @if($course && $course->image)
                            <p class="text-xs text-gray-500 mt-1">Current: {{ basename($course->image) }}</p>
                        @endif
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Trainer</label>
                    <select name="trainer_id" class="w-full px-3 py-2 border rounded-lg text-sm">
                        <option value="">None</option>
                        @foreach($trainers as $t)<option value="{{ $t->id }}" {{ old('trainer_id', $course->trainer_id ?? '') == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>@endforeach
                    </select>
                </div>

                <button type="submit"
                    class="px-6 py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition">{{ $course ? 'Update Course' : 'Create Course' }}</button>
            </form>
        </div>
    </div>
@endsection