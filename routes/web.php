<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════
// PUBLIC PAGES
// ══════════════════════════════════════════
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{service}', [PageController::class, 'serviceDetail'])->name('service.detail');
Route::get('/projects', [PageController::class, 'projects'])->name('projects');
Route::get('/projects/{project}', [PageController::class, 'projectDetail'])->name('project.detail');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{blog}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::post('/newsletter/subscribe', [PageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// ══════════════════════════════════════════
// AUTHENTICATION
// ══════════════════════════════════════════
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');

// ══════════════════════════════════════════
// ADMIN
// ══════════════════════════════════════════
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/role', [AdminController::class, 'changeRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Portfolio - Projects
    Route::get('/projects', [AdminController::class, 'projects'])->name('projects');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('projects.store');
    Route::get('/projects/{project}/edit', [AdminController::class, 'editProject'])->name('projects.edit');
    Route::put('/projects/{project}', [AdminController::class, 'updateProject'])->name('projects.update');
    Route::delete('/projects/{project}', [AdminController::class, 'deleteProject'])->name('projects.delete');

    // Portfolio - Services
    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::get('/services/create', [AdminController::class, 'createService'])->name('services.create');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::get('/services/{service}/edit', [AdminController::class, 'editService'])->name('services.edit');
    Route::put('/services/{service}', [AdminController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{service}', [AdminController::class, 'deleteService'])->name('services.delete');

    // Portfolio - Testimonials
    Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
    Route::get('/testimonials/create', [AdminController::class, 'createTestimonial'])->name('testimonials.create');
    Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('testimonials.store');
    Route::get('/testimonials/{testimonial}/edit', [AdminController::class, 'editTestimonial'])->name('testimonials.edit');
    Route::put('/testimonials/{testimonial}', [AdminController::class, 'updateTestimonial'])->name('testimonials.update');
    Route::delete('/testimonials/{testimonial}', [AdminController::class, 'deleteTestimonial'])->name('testimonials.delete');

    // Portfolio - Social Links
    Route::get('/social-links', [AdminController::class, 'socialLinks'])->name('social-links');
    Route::post('/social-links', [AdminController::class, 'storeSocialLink'])->name('social-links.store');
    Route::put('/social-links/{socialLink}', [AdminController::class, 'updateSocialLink'])->name('social-links.update');
    Route::delete('/social-links/{socialLink}', [AdminController::class, 'deleteSocialLink'])->name('social-links.delete');

    // Portfolio - Hero Section
    Route::get('/hero', [AdminController::class, 'heroSection'])->name('hero');
    Route::put('/hero', [AdminController::class, 'updateHeroSection'])->name('hero.update');

    // Portfolio - About Section
    Route::get('/about', [AdminController::class, 'aboutSection'])->name('about');
    Route::put('/about', [AdminController::class, 'updateAboutSection'])->name('about.update');

    // Portfolio - Section Settings
    Route::get('/sections', [AdminController::class, 'sectionSettings'])->name('sections');
    Route::put('/sections', [AdminController::class, 'updateSectionSettings'])->name('sections.update');

    // Blogs
    Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs');
    Route::get('/blogs/create', [AdminController::class, 'createBlog'])->name('blogs.create');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::get('/blogs/{blog}/edit', [AdminController::class, 'editBlog'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [AdminController::class, 'updateBlog'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [AdminController::class, 'deleteBlog'])->name('blogs.delete');

    // Contacts
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::delete('/contacts/{message}', [AdminController::class, 'deleteContact'])->name('contacts.delete');

    // Reviews
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/approve', [AdminController::class, 'approveReview'])->name('reviews.approve');
    Route::post('/reviews/{review}/reject', [AdminController::class, 'rejectReview'])->name('reviews.reject');

    // Subscribers
    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');

    // Site Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])->name('settings');
    Route::post('/settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])->name('settings.update');

    // Maintenance
    Route::get('/maintenance/{command}', function ($command) {
        $allowedCommands = ['storage-link', 'cache-clear', 'view-clear', 'config-cache', 'migrate'];
        if (!in_array($command, $allowedCommands)) {
            return back()->with('error', 'Invalid maintenance command.');
        }

        try {
            switch ($command) {
                case 'storage-link':
                    \Illuminate\Support\Facades\Artisan::call('storage:link');
                    break;
                case 'cache-clear':
                    \Illuminate\Support\Facades\Artisan::call('cache:clear');
                    break;
                case 'view-clear':
                    \Illuminate\Support\Facades\Artisan::call('view:clear');
                    break;
                case 'config-cache':
                    \Illuminate\Support\Facades\Artisan::call('config:cache');
                    break;
                case 'migrate':
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                    break;
            }
            return back()->with('success', "Command '{$command}' executed successfully!");
        } catch (\Exception $e) {
            return back()->with('error', "Error: " . $e->getMessage());
        }
    })->name('maintenance');
});

// ══════════════════════════════════════════
// WEBHOOKS
// ══════════════════════════════════════════
Route::post('/webhook/payment', [PaymentController::class, 'paymentWebhook'])->name('webhook.payment');
