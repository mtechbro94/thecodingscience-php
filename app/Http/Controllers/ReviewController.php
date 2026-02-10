<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:2000',
        ]);

        // One review per user per course
        $existing = CourseReview::where('course_id', $course->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existing) {
            $existing->update([
                'rating' => $request->rating,
                'review_text' => $request->review_text,
                'is_approved' => false, // Re-moderation
            ]);
            return back()->with('success', 'Review updated! It will appear after approval.');
        }

        CourseReview::create([
            'course_id' => $course->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        return back()->with('success', 'Review submitted! It will appear after approval.');
    }

    public function destroy(CourseReview $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }
        $review->delete();
        return back()->with('success', 'Review deleted.');
    }
}
