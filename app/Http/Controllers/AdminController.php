<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Internship;
use App\Models\Enrollment;
use App\Models\User;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\InternshipApplication;
use App\Models\CourseReview;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalStudents' => User::where('role', 'student')->count(),
            'totalTrainers' => User::where('role', 'trainer')->count(),
            'totalCourses' => Course::count(),
            'totalEnrollments' => Enrollment::where('status', 'completed')->count(),
            'pendingPayments' => Enrollment::where('status', 'pending')->count(),
            'totalRevenue' => Enrollment::where('status', 'completed')->sum('amount_paid'),
            'totalBlogs' => Blog::count(),
            'totalContacts' => ContactMessage::count(),
            'pendingTrainers' => User::where('role', 'trainer')->where('is_approved', false)->count(),
        ]);
    }

    // ── Users ──

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function approveTrainer(User $user)
    {
        $user->update(['is_approved' => true]);
        return back()->with('success', "Trainer {$user->name} approved!");
    }

    public function changeRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|in:student,trainer,admin']);
        $user->update(['role' => $request->role]);
        return back()->with('success', "Role updated to {$request->role} for {$user->name}.");
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted.');
    }

    // ── Courses ──

    public function courses()
    {
        $courses = Course::with('trainer')->latest()->get();
        $trainers = User::where('role', 'trainer')->where('is_approved', true)->get();
        return view('admin.courses', compact('courses', 'trainers'));
    }

    public function createCourse()
    {
        $trainers = User::where('role', 'trainer')->where('is_approved', true)->get();
        return view('admin.course-form', ['course' => null, 'trainers' => $trainers]);
    }

    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'summary' => 'nullable|string|max:300',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'level' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'curriculum' => 'nullable|array',
            'trainer_id' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        Course::create($validated);
        return redirect()->route('admin.courses')->with('success', 'Course created!');
    }

    public function editCourse(Course $course)
    {
        $trainers = User::where('role', 'trainer')->where('is_approved', true)->get();
        return view('admin.course-form', compact('course', 'trainers'));
    }

    public function updateCourse(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'description' => 'nullable|string',
            'summary' => 'nullable|string|max:300',
            'duration' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'level' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'curriculum' => 'nullable|array',
            'trainer_id' => 'nullable|exists:users,id',
        ]);

        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);
        return redirect()->route('admin.courses')->with('success', 'Course updated!');
    }

    public function deleteCourse(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Course deleted.');
    }

    // ── Enrollments ──

    public function enrollments()
    {
        $enrollments = Enrollment::with(['student', 'course'])->latest()->paginate(20);
        return view('admin.enrollments', compact('enrollments'));
    }

    public function verifyEnrollment(Enrollment $enrollment)
    {
        $enrollment->update([
            'status' => 'completed',
            'verified_at' => now(),
        ]);
        return back()->with('success', 'Payment verified!');
    }

    public function deleteEnrollment(Enrollment $enrollment)
    {
        $enrollment->delete();
        return back()->with('success', 'Enrollment deleted.');
    }

    // ── Blogs ──

    public function blogs()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs', compact('blogs'));
    }

    public function createBlog()
    {
        return view('admin.blog-form', ['blog' => null]);
    }

    public function storeBlog(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'required|string|max:100',
            'display_date' => 'nullable|string|max:50',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($validated);
        return redirect()->route('admin.blogs')->with('success', 'Blog published!');
    }

    public function editBlog(Blog $blog)
    {
        return view('admin.blog-form', compact('blog'));
    }

    public function updateBlog(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author' => 'required|string|max:100',
            'display_date' => 'nullable|string|max:50',
            'is_published' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $validated['image'] = $request->file('image')->store('blogs', 'public');
        }

        $blog->update($validated);
        return redirect()->route('admin.blogs')->with('success', 'Blog updated!');
    }

    public function deleteBlog(Blog $blog)
    {
        $blog->delete();
        return back()->with('success', 'Blog deleted.');
    }

    // ── Contact Messages ──

    public function contacts()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contacts', compact('messages'));
    }

    public function deleteContact(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success', 'Message deleted.');
    }

    // ── Internship Applications ──

    public function internshipApplications()
    {
        $applications = InternshipApplication::latest()->paginate(20);
        return view('admin.internships-applications', compact('applications'));
    }

    public function updateInternshipStatus(Request $request, InternshipApplication $application)
    {
        $request->validate(['status' => 'required|in:pending,accepted,rejected']);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Status updated.');
    }

    // ── Reviews ──

    public function reviews()
    {
        $reviews = CourseReview::with(['course', 'user'])->latest()->paginate(20);
        return view('admin.reviews', compact('reviews'));
    }

    public function approveReview(CourseReview $review)
    {
        $review->update(['is_approved' => true]);
        return back()->with('success', 'Review approved.');
    }

    public function rejectReview(CourseReview $review)
    {
        $review->update(['is_approved' => false]);
        return back()->with('success', 'Review rejected.');
    }

    // ── Newsletter ──

    public function subscribers()
    {
        return view('admin.subscribers', compact('subscribers'));
    }

    // ── Internships ──

    public function internships()
    {
        return view('admin.internships', ['internships' => Internship::latest()->get()]);
    }

    public function createInternship()
    {
        return view('admin.internship-form', ['internship' => null]);
    }

    public function storeInternship(Request $request)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:200',
            'company' => 'required|string|max:200',
            'duration' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'stipend' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('internships', 'public');
        }

        Internship::create($validated);
        return redirect()->route('admin.internships')->with('success', 'Internship created!');
    }

    public function editInternship(Internship $internship)
    {
        return view('admin.internship-form', compact('internship'));
    }

    public function updateInternship(Request $request, Internship $internship)
    {
        $validated = $request->validate([
            'role' => 'required|string|max:200',
            'company' => 'required|string|max:200',
            'duration' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'stipend' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($internship->image) {
                Storage::disk('public')->delete($internship->image);
            }
            $validated['image'] = $request->file('image')->store('internships', 'public');
        }

        $internship->update($validated);
        return redirect()->route('admin.internships')->with('success', 'Internship updated!');
    }

    public function deleteInternship(Internship $internship)
    {
        if ($internship->image) {
            Storage::disk('public')->delete($internship->image);
        }
        $internship->delete();
        return redirect()->route('admin.internships')->with('success', 'Internship deleted!');
    }
}

