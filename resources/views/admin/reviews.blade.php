@extends('layouts.admin')
@section('title', 'Reviews')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Student</th>
                        <th class="px-4 py-3 text-left">Course</th>
                        <th class="px-4 py-3">Rating</th>
                        <th class="px-4 py-3 text-left">Review</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($reviews as $r)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $r->user->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $r->course->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-center text-yellow-500">@for($i = 0; $i < $r->rating; $i++)<i
                            class="fas fa-star text-xs"></i>@endfor</td>
                            <td class="px-4 py-3 text-gray-600 max-w-xs truncate">{{ $r->review_text ?? '—' }}</td>
                            <td class="px-4 py-3 text-center"><span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $r->is_approved ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">{{ $r->is_approved ? 'Approved' : 'Pending' }}</span>
                            </td>
                            <td class="px-4 py-3 text-center space-x-1">
                                @if(!$r->is_approved)
                                    <form method="POST" action="{{ route('admin.reviews.approve', $r) }}" class="inline">
                                        @csrf<button class="px-2 py-1 bg-green-600 text-white rounded text-xs">Approve</button>
                                </form>@endif
                                @if($r->is_approved)
                                    <form method="POST" action="{{ route('admin.reviews.reject', $r) }}" class="inline">@csrf<button
                                class="px-2 py-1 bg-red-600 text-white rounded text-xs">Reject</button></form>@endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $reviews->links() }}</div>
    </div>
@endsection