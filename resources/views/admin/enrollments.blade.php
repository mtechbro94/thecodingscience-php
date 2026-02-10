@extends('layouts.admin')
@section('title', 'Enrollments')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Student</th>
                        <th class="px-4 py-3 text-left">Course</th>
                        <th class="px-4 py-3">UTR</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($enrollments as $e)
                        <tr class="hover:bg-gray-50 {{ $e->status === 'pending' ? 'bg-yellow-50' : '' }}">
                            <td class="px-4 py-3 font-medium">{{ $e->student->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $e->course->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center font-mono text-xs">{{ $e->utr ?? '—' }}</td>
                            <td class="px-4 py-3 text-center">{{ $e->amount_paid ? '₹' . number_format($e->amount_paid) : '—' }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $e->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ ucfirst($e->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $e->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                @if($e->status === 'pending')
                                    <form method="POST" action="{{ route('admin.enrollments.verify', $e) }}" class="inline">
                                        @csrf<button class="px-2 py-1 bg-green-600 text-white rounded text-xs hover:bg-green-700"><i
                                                class="fas fa-check mr-1"></i>Verify</button></form>
                                @endif
                                <form method="POST" action="{{ route('admin.enrollments.delete', $e) }}" class="inline"
                                    onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                        class="text-red-500 hover:text-red-700 text-xs"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $enrollments->links() }}</div>
    </div>
@endsection