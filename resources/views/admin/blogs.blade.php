@extends('layouts.admin')
@section('title', 'Blogs')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold">All Blog Posts</h2>
        <a href="{{ route('admin.blogs.create') }}"
            class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition"><i
                class="fas fa-plus mr-1"></i>New Post</a>
    </div>
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Title</th>
                        <th class="px-4 py-3">Author</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($blogs as $blog)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $blog->title }}</td>
                            <td class="px-4 py-3 text-center text-gray-500">{{ $blog->author }}</td>
                            <td class="px-4 py-3 text-center"><span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $blog->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $blog->is_published ? 'Published' : 'Draft' }}</span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                    class="text-blue-600 hover:text-blue-800 text-xs"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('admin.blogs.delete', $blog) }}" class="inline"
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