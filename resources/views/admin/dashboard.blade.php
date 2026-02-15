@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $cards = [
                ['label' => 'Total Users', 'value' => $totalUsers, 'icon' => 'fa-users', 'color' => 'blue'],
                ['label' => 'Students', 'value' => $totalStudents, 'icon' => 'fa-graduation-cap', 'color' => 'indigo'],
                ['label' => 'Courses', 'value' => $totalCourses, 'icon' => 'fa-book', 'color' => 'purple'],
                ['label' => 'Enrollments', 'value' => $totalEnrollments, 'icon' => 'fa-check-circle', 'color' => 'green'],
                ['label' => 'Pending Payments', 'value' => $pendingPayments, 'icon' => 'fa-clock', 'color' => 'yellow'],
                ['label' => 'Revenue', 'value' => '₹' . number_format($totalRevenue), 'icon' => 'fa-rupee-sign', 'color' => 'emerald'],
                ['label' => 'Blog Posts', 'value' => $totalBlogs, 'icon' => 'fa-newspaper', 'color' => 'pink'],
                ['label' => 'Pending Trainers', 'value' => $pendingTrainers, 'icon' => 'fa-user-clock', 'color' => 'red'],
            ];
        @endphp
        @foreach($cards as $c)
            <div class="bg-white rounded-xl p-5 border shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $c['label'] }}</p>
                        <p class="text-2xl font-bold mt-1">{{ $c['value'] }}</p>
                    </div>
                    <div class="w-10 h-10 bg-{{ $c['color'] }}-100 rounded-lg flex items-center justify-center">
                        <i class="fas {{ $c['icon'] }} text-{{ $c['color'] }}-600"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <h3 class="font-bold mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('admin.courses.create') }}"
                    class="p-3 bg-primary-50 text-primary-700 rounded-lg text-sm font-medium hover:bg-primary-100 transition text-center"><i
                        class="fas fa-plus mr-1"></i>Add Course</a>
                <a href="{{ route('admin.blogs.create') }}"
                    class="p-3 bg-pink-50 text-pink-700 rounded-lg text-sm font-medium hover:bg-pink-100 transition text-center"><i
                        class="fas fa-plus mr-1"></i>Add Blog</a>
                <a href="{{ route('admin.enrollments') }}"
                    class="p-3 bg-yellow-50 text-yellow-700 rounded-lg text-sm font-medium hover:bg-yellow-100 transition text-center"><i
                        class="fas fa-credit-card mr-1"></i>Verify Payments</a>
                <a href="{{ route('admin.users') }}"
                    class="p-3 bg-green-50 text-green-700 rounded-lg text-sm font-medium hover:bg-green-100 transition text-center"><i
                        class="fas fa-users mr-1"></i>Manage Users</a>
                <a href="{{ route('admin.internships') }}"
                    class="p-3 bg-indigo-50 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition text-center"><i
                        class="fas fa-briefcase mr-1"></i>Manage Internships</a>
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <h3 class="font-bold mb-4">System Maintenance</h3>
            <div class="grid grid-cols-1 gap-2">
                <a href="{{ route('admin.maintenance', 'storage-link') }}"
                    onclick="return confirm('Ensure storage directory is writable. Proceed?')"
                    class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg border text-xs">
                    <span><i class="fas fa-link mr-2 text-blue-500"></i>Link Storage</span>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
                <a href="{{ route('admin.maintenance', 'cache-clear') }}"
                    class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg border text-xs">
                    <span><i class="fas fa-broom mr-2 text-yellow-500"></i>Clear App Cache</span>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
                <a href="{{ route('admin.maintenance', 'view-clear') }}"
                    class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg border text-xs">
                    <span><i class="fas fa-eye mr-2 text-purple-500"></i>Clear View Cache</span>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
                <a href="{{ route('admin.maintenance', 'config-cache') }}"
                    class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg border text-xs">
                    <span><i class="fas fa-cogs mr-2 text-green-500"></i>Optimize Config</span>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
                <a href="{{ route('admin.maintenance', 'migrate') }}"
                    onclick="return confirm('This will run database migrations. Proceed?')"
                    class="flex items-center justify-between p-2 hover:bg-gray-50 rounded-lg border text-xs">
                    <span><i class="fas fa-database mr-2 text-red-500"></i>Run Migrations</span>
                    <i class="fas fa-chevron-right text-gray-300"></i>
                </a>
            </div>
        </div>
        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <h3 class="font-bold mb-4">Recent Stats</h3>
            <ul class="space-y-3 text-sm">
                <li class="flex justify-between"><span class="text-gray-600">Total Trainers</span><span
                        class="font-semibold">{{ $totalTrainers }}</span></li>
                <li class="flex justify-between"><span class="text-gray-600">Contact Messages</span><span
                        class="font-semibold">{{ $totalContacts }}</span></li>
                <li class="flex justify-between"><span class="text-gray-600">Pending Trainers</span><span
                        class="font-semibold {{ $pendingTrainers > 0 ? 'text-red-600' : '' }}">{{ $pendingTrainers }}</span>
                </li>
                <li class="flex justify-between"><span class="text-gray-600">Pending Payments</span><span
                        class="font-semibold {{ $pendingPayments > 0 ? 'text-yellow-600' : '' }}">{{ $pendingPayments }}</span>
                </li>
            </ul>
        </div>
    </div>
@endsection