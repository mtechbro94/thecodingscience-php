@extends('layouts.admin')
@section('title', 'Courses')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">All Courses</h2>
        <a href="{{ route('admin.courses.create') }}"
            class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition"><i
                class="fas fa-plus mr-1"></i>Add Course</a>
    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3">Level</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Trainer</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $course->name }}</td>
                            <td class="px-4 py-3 text-center"><span
                                    class="px-2 py-1 bg-primary-50 text-primary-700 rounded-full text-xs">{{ $course->level }}</span>
                            </td>
                            <td class="px-4 py-3 text-center font-semibold">₹{{ number_format($course->price) }}</td>
                            <td class="px-4 py-3 text-center text-gray-500">{{ $course->trainer->name ?? '—' }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.courses.edit', $course) }}"
                                    class="text-blue-600 hover:text-blue-800 text-xs"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.courses.delete', $course) }}" class="inline"
                                    onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                        class="text-red-500 hover:text-red-700 text-xs"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection