@extends('layouts.admin')
@section('title', 'Internship Applications')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($applications as $app)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $app->name }}</td>
                            <td class="px-4 py-3">{{ $app->internship_role }}</td>
                            <td class="px-4 py-3 text-center text-gray-500">{{ $app->email }}</td>
                            <td class="px-4 py-3 text-center">{{ $app->phone }}</td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $app->status === 'accepted' ? 'bg-green-100 text-green-700' : ($app->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ ucfirst($app->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @if($app->status === 'pending')
                                    <form method="POST" action="{{ route('admin.internships.status', $app) }}" class="inline">
                                        @csrf<input type="hidden" name="status" value="accepted"><button
                                            class="px-2 py-1 bg-green-600 text-white rounded text-xs">Accept</button></form>
                                    <form method="POST" action="{{ route('admin.internships.status', $app) }}" class="inline">
                                        @csrf<input type="hidden" name="status" value="rejected"><button
                                            class="px-2 py-1 bg-red-600 text-white rounded text-xs">Reject</button></form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $applications->links() }}</div>
    </div>
@endsection