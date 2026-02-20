<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SocialLink;
use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\SectionSetting;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $hero = HeroSection::where('is_active', true)->first();
        $about = AboutSection::where('is_active', true)->first();
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $projects = Project::where('is_active', true)->orderBy('order')->get();
        $featuredProjects = Project::where('is_active', true)->where('is_featured', true)->orderBy('order')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(5)->get();
        $blogs = Blog::published()->latest()->take(3)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.home', compact(
            'hero', 'about', 'services', 'projects', 'featuredProjects',
            'testimonials', 'blogs', 'socialLinks'
        ));
    }

    public function about()
    {
        $about = AboutSection::where('is_active', true)->first();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(5)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.about', compact('about', 'testimonials', 'socialLinks'));
    }

    public function services()
    {
        $services = Service::where('is_active', true)->orderBy('order')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.services', compact('services', 'socialLinks'));
    }

    public function serviceDetail(Service $service)
    {
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();
        return view('frontend.service-detail', compact('service', 'socialLinks'));
    }

    public function projects()
    {
        $projects = Project::where('is_active', true)->orderBy('order')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.projects', compact('projects', 'socialLinks'));
    }

    public function projectDetail(Project $project)
    {
        $relatedProjects = Project::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.project-detail', compact('project', 'relatedProjects', 'socialLinks'));
    }

    public function blog()
    {
        $blogs = Blog::published()->latest()->paginate(9);
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.blog', compact('blogs', 'socialLinks'));
    }

    public function blogDetail(Blog $blog)
    {
        if (!$blog->is_published) {
            abort(404);
        }
        $recent = Blog::published()->where('id', '!=', $blog->id)->latest()->take(3)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.blog-detail', compact('blog', 'recent', 'socialLinks'));
    }

    public function contact()
    {
        $about = AboutSection::where('is_active', true)->first();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('frontend.contact', compact('about', 'socialLinks'));
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
