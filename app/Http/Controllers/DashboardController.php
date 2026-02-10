<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function studentDashboard()
    {
        $enrollments = Enrollment::with('course')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('dashboard.student', compact('enrollments'));
    }

    public function trainerDashboard()
    {
        $courses = Course::where('trainer_id', auth()->id())->with('enrollments')->get();

        $totalStudents = 0;
        foreach ($courses as $course) {
            $totalStudents += $course->enrollments->where('status', 'completed')->count();
        }

        return view('dashboard.trainer', compact('courses', 'totalStudents'));
    }
}
