<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function enroll(Course $course)
    {
        // Check if already enrolled
        $existing = Enrollment::where('user_id', auth()->id())
            ->where('course_id', $course->id)
            ->first();

        if ($existing) {
            if ($existing->status === 'completed') {
                return redirect()->route('course.detail', $course)
                    ->with('info', 'You are already enrolled in this course.');
            }
            // Pending enrollment exists — show payment page
            return view('payment.upi', [
                'course' => $course,
                'enrollment' => $existing,
            ]);
        }

        // Create pending enrollment
        $enrollment = Enrollment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'status' => 'pending',
        ]);

        return view('payment.upi', compact('course', 'enrollment'));
    }

    public function submitUtr(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'utr' => 'required|string|min:8|max:50',
        ]);

        $enrollment->update([
            'utr' => $request->utr,
            'payment_method' => 'upi',
            'payment_gateway' => 'upi-manual',
            'amount_paid' => $enrollment->course->price,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Payment reference submitted! Your enrollment will be verified shortly.');
    }
}
