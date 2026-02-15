@extends('layouts.admin')
@section('title', 'Internships')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">Internship Roles</h2>
        <div class="space-x-2">
            <a href="{{ route('internships.applications') }}"
                class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition">View
                Applications</a>
            <a href="{{ route('admin.internships.create') }}"
                class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition"><i
                    class="fas fa-plus mr-1"></i>Add Role</a>
        </div>
    </div>

    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3">Duration</th>
                        <th class="px-4 py-3">Stipend</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($internships as $internship)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                <div class="font-medium">{{ $internship->role }}</div>
                                <div class="text-xs text-gray-400">{{ $internship->company }}</div>
                            </td>
                            <td class="px-4 py-3 text-center">{{ $internship->duration }}</td>
                            <td class="px-4 py-3 text-center font-semibold">₹{{ number_format($internship->stipend) }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($internship->is_active)
                                    <span class="px-2 py-1 bg-green-50 text-green-700 rounded-full text-xs">Active</span>
                                @else
                                    <span class="px-2 py-1 bg-red-50 text-red-700 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.internships.edit', $internship) }}"
                                    class="text-blue-600 hover:text-blue-800 text-xs"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.internships.delete', $internship) }}" class="inline"
                                    onsubmit="return confirm('Delete role?')">@csrf @method('DELETE')<button
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