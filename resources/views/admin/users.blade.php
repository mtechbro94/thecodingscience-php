@extends('layouts.admin')
@section('title', 'Users')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Joined</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : ($user->role === 'trainer' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if($user->role === 'trainer' && !$user->is_approved)
                                    <form method="POST" action="{{ route('admin.users.approve', $user) }}" class="inline">@csrf
                                        <button
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-xs font-semibold hover:bg-yellow-200">Approve</button>
                                    </form>
                                @else
                                    <span class="text-green-600 text-xs"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline"
                                    onsubmit="return confirm('Delete this user?')">@csrf @method('DELETE')
                                    <button class="text-red-500 hover:text-red-700 text-xs"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $users->links() }}</div>
    </div>
@endsection