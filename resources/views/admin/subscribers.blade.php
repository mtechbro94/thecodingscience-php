@extends('layouts.admin')
@section('title', 'Newsletter Subscribers')

@section('content')
    <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Subscribed</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($subscribers as $sub)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium">{{ $sub->email }}</td>
                            <td class="px-4 py-3 text-center"><span
                                    class="px-2 py-1 rounded-full text-xs font-semibold {{ $sub->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $sub->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-400 text-xs">{{ $sub->created_at->format('M d, Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4">{{ $subscribers->links() }}</div>
    </div>
@endsection