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
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\SectionSetting;
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
        $subscribers = NewsletterSubscriber::latest()->paginate(20);
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

    // ══════════════════════════════════════════
    // PORTFOLIO MANAGEMENT
    // ══════════════════════════════════════════

    // Projects
    public function projects()
    {
        $projects = Project::orderBy('order')->get();
        return view('admin.portfolio.projects', compact('projects'));
    }

    public function createProject()
    {
        return view('admin.portfolio.project-form', ['project' => null]);
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'client_name' => 'nullable|string|max:100',
            'project_url' => 'nullable|string|max:200',
            'github_url' => 'nullable|string|max:200',
            'technologies' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        Project::create($validated);
        return redirect()->route('admin.projects')->with('success', 'Project created!');
    }

    public function editProject(Project $project)
    {
        return view('admin.portfolio.project-form', compact('project'));
    }

    public function updateProject(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'client_name' => 'nullable|string|max:100',
            'project_url' => 'nullable|string|max:200',
            'github_url' => 'nullable|string|max:200',
            'technologies' => 'nullable|string|max:500',
            'order' => 'nullable|integer|min:0',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_active'] = $request->has('is_active');

        $project->update($validated);
        return redirect()->route('admin.projects')->with('success', 'Project updated!');
    }

    public function deleteProject(Project $project)
    {
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        return back()->with('success', 'Project deleted.');
    }

    // Services
    public function services()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.portfolio.services', compact('services'));
    }

    public function createService()
    {
        return view('admin.portfolio.service-form', ['service' => null]);
    }

    public function storeService(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Service::create($validated);
        return redirect()->route('admin.services')->with('success', 'Service created!');
    }

    public function editService(Service $service)
    {
        return view('admin.portfolio.service-form', compact('service'));
    }

    public function updateService(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);
        return redirect()->route('admin.services')->with('success', 'Service updated!');
    }

    public function deleteService(Service $service)
    {
        $service->delete();
        return back()->with('success', 'Service deleted.');
    }

    // Testimonials
    public function testimonials()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.portfolio.testimonials', compact('testimonials'));
    }

    public function createTestimonial()
    {
        return view('admin.portfolio.testimonial-form', ['testimonial' => null]);
    }

    public function storeTestimonial(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'designation' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 5;

        Testimonial::create($validated);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial created!');
    }

    public function editTestimonial(Testimonial $testimonial)
    {
        return view('admin.portfolio.testimonial-form', compact('testimonial'));
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:200',
            'designation' => 'nullable|string|max:100',
            'company' => 'nullable|string|max:100',
            'message' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($testimonial->image) {
                Storage::disk('public')->delete($testimonial->image);
            }
            $validated['image'] = $request->file('image')->store('testimonials', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $testimonial->update($validated);
        return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated!');
    }

    public function deleteTestimonial(Testimonial $testimonial)
    {
        if ($testimonial->image) {
            Storage::disk('public')->delete($testimonial->image);
        }
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted.');
    }

    // Social Links
    public function socialLinks()
    {
        $socialLinks = SocialLink::orderBy('order')->get();
        return view('admin.portfolio.social-links', compact('socialLinks'));
    }

    public function storeSocialLink(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'url' => 'required|string|max:200',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['icon'] = $validated['icon'] ?? 'fab fa-' . strtolower($validated['platform']);

        SocialLink::create($validated);
        return back()->with('success', 'Social link added!');
    }

    public function updateSocialLink(Request $request, SocialLink $socialLink)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:100',
            'url' => 'required|string|max:200',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $socialLink->update($validated);
        return back()->with('success', 'Social link updated!');
    }

    public function deleteSocialLink(SocialLink $socialLink)
    {
        $socialLink->delete();
        return back()->with('success', 'Social link deleted.');
    }

    // Hero Section
    public function heroSection()
    {
        $hero = HeroSection::first();
        return view('admin.portfolio.hero', compact('hero'));
    }

    public function updateHeroSection(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'subtitle' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:200',
            'cta2_text' => 'nullable|string|max:100',
            'cta2_link' => 'nullable|string|max:200',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $hero = HeroSection::first();
        
        if ($request->hasFile('image')) {
            if ($hero && $hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $validated['image'] = $request->file('image')->store('hero', 'public');
        }

        if ($hero) {
            $hero->update($validated);
        } else {
            HeroSection::create($validated);
        }

        return back()->with('success', 'Hero section updated!');
    }

    // About Section
    public function aboutSection()
    {
        $about = AboutSection::first();
        return view('admin.portfolio.about', compact('about'));
    }

    public function updateAboutSection(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:500',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'resume_url' => 'nullable|string|max:500',
            'skills' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        
        if ($validated['skills']) {
            $validated['skills'] = array_map('trim', explode(',', $validated['skills']));
        } else {
            $validated['skills'] = [];
        }

        $about = AboutSection::first();

        if ($request->hasFile('image')) {
            if ($about && $about->image) {
                Storage::disk('public')->delete($about->image);
            }
            $validated['image'] = $request->file('image')->store('about', 'public');
        }

        if ($about) {
            $about->update($validated);
        } else {
            AboutSection::create($validated);
        }

        return back()->with('success', 'About section updated!');
    }

    // Section Settings
    public function sectionSettings()
    {
        $sections = SectionSetting::orderBy('order')->get();
        return view('admin.portfolio.sections', compact('sections'));
    }

    public function updateSectionSettings(Request $request)
    {
        foreach ($request->sections as $id => $data) {
            SectionSetting::where('id', $id)->update([
                'title' => $data['title'] ?? null,
                'subtitle' => $data['subtitle'] ?? null,
                'is_enabled' => isset($data['is_enabled']),
                'order' => $data['order'] ?? 0,
            ]);
        }

        return back()->with('success', 'Section settings updated!');
    }
}

