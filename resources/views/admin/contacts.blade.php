@extends('layouts.admin')
@section('title', 'Contact Messages')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Subject</th>
                        <th class="px-4 py-3 text-left">Message</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($messages as $msg)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $msg->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $msg->email }}</td>
                            <td class="px-4 py-3">{{ $msg->subject ?? '—' }}</td>
                            <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $msg->message }}</td>
                            <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $msg->created_at->format('M d') }}</td>
                            <td class="px-4 py-3 text-center">
                                <form method="POST" action="{{ route('admin.contacts.delete', $msg) }}" class="inline"
                                    onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                        class="text-red-500 text-xs"><i class="fas fa-trash"></i></button></form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $messages->links() }}</div>
    </div>
@endsection