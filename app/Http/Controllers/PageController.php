<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\InternshipApplication;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // ── Static content arrays (ported from Flask content_data.py) ──

    private function services(): array
    {
        return [
            ['id' => 1, 'title' => 'Computer Science Engineering', 'icon' => 'fa-microchip', 'description' => 'Master programming fundamentals, data structures, algorithms, and computer architecture.', 'duration' => '2-4 Months', 'price' => '499-1499'],
            ['id' => 2, 'title' => 'AI & Machine Learning', 'icon' => 'fa-robot', 'description' => 'Build intelligent systems with neural networks, deep learning, NLP, and computer vision.', 'duration' => '3-4 Months', 'price' => '999-1499'],
            ['id' => 3, 'title' => 'Programming & DSA', 'icon' => 'fa-code', 'description' => 'Learn Python, Java, problem-solving, and crack coding interviews with confidence.', 'duration' => '3-4 Months', 'price' => '999-1499'],
            ['id' => 4, 'title' => 'Cloud Computing & DevOps', 'icon' => 'fa-cloud', 'description' => 'Master AWS, Docker, Kubernetes, CI/CD pipelines, and modern deployment practices.', 'duration' => '3-4 Months', 'price' => '1499'],
        ];
    }

    private function internships(): array
    {
        return [
            ['id' => 1, 'role' => 'Web Development Intern', 'company' => 'School of Technology and AI Innovations', 'duration' => '3 Months', 'location' => 'Remote', 'stipend' => 999, 'description' => 'Build real-world websites with React, Node.js & MongoDB. Gain hands-on experience with modern web technologies and industry best practices.'],
            ['id' => 2, 'role' => 'Python Development Intern', 'company' => 'School of Technology and AI Innovations', 'duration' => '3 Months', 'location' => 'Remote', 'stipend' => 999, 'description' => 'Master backend development with Python. Build APIs, manage databases, and work on real-world projects with experienced mentors.'],
            ['id' => 3, 'role' => 'Data Science and AI Intern', 'company' => 'School of Technology and AI Innovations', 'duration' => '3 Months', 'location' => 'Remote', 'stipend' => 999, 'description' => 'Work with real datasets and build ML models. Learn machine learning, deep learning, and solve real-world AI problems.'],
        ];
    }

    private function aboutValues(): array
    {
        return [
            ['icon' => 'fa-lightbulb', 'title' => 'Innovation', 'desc' => 'Embracing the latest technology and teaching methods to stay ahead.'],
            ['icon' => 'fa-star', 'title' => 'Excellence', 'desc' => 'Delivering the highest quality training with industry standards.'],
            ['icon' => 'fa-hand-holding-heart', 'title' => 'Integrity', 'desc' => 'Transparency and honesty in guiding student careers.'],
            ['icon' => 'fa-users', 'title' => 'Community', 'desc' => 'Building a supportive network of lifelong learners and mentors.'],
        ];
    }

    // ── Page methods ──

    public function home()
    {
        $courses = Course::latest()->take(6)->get();
        $blogs = Blog::published()->latest()->take(3)->get();

        return view('pages.home', compact('courses', 'blogs'));
    }

    public function about()
    {
        return view('pages.about', ['values' => $this->aboutValues()]);
    }

    public function courses()
    {
        $courses = Course::all();
        return view('pages.courses', compact('courses'));
    }

    public function courseDetail(Course $course)
    {
        $reviews = $course->approvedReviews()->with('user')->latest()->get();
        $avgRating = $course->averageRating();
        $isEnrolled = false;
        if (auth()->check()) {
            $isEnrolled = $course->enrollments()
                ->where('user_id', auth()->id())
                ->where('status', 'completed')
                ->exists();
        }

        return view('pages.course-detail', compact('course', 'reviews', 'avgRating', 'isEnrolled'));
    }

    public function servicesPage()
    {
        return view('pages.services', ['services' => $this->services()]);
    }

    public function internshipsPage()
    {
        return view('pages.internships', ['internships' => $this->internships()]);
    }

    public function blog()
    {
        $blogs = Blog::published()->latest()->paginate(9);
        return view('pages.blog', compact('blogs'));
    }

    public function blogDetail(Blog $blog)
    {
        if (!$blog->is_published) {
            abort(404);
        }
        $recent = Blog::published()->where('id', '!=', $blog->id)->latest()->take(3)->get();
        return view('pages.blog-detail', compact('blog', 'recent'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:5000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }

    public function applyInternship(Request $request)
    {
        $validated = $request->validate([
            'internship_id' => 'required|integer',
            'internship_role' => 'required|string|max:200',
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:120',
            'phone' => 'required|string|max:20',
            'cover_letter' => 'nullable|string|max:5000',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        InternshipApplication::create($validated);

        return back()->with('success', 'Application submitted successfully!');
    }

    public function subscribeNewsletter(Request $request)
    {
        $request->validate(['email' => 'required|email|max:120']);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $request->email],
            ['is_active' => true]
        );

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
