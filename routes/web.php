<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// ══════════════════════════════════════════
// PUBLIC PAGES
// ══════════════════════════════════════════
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/courses', [PageController::class, 'courses'])->name('courses');
Route::get('/course/{course}', [PageController::class, 'courseDetail'])->name('course.detail');
Route::get('/services', [PageController::class, 'servicesPage'])->name('services');
Route::get('/internships', [PageController::class, 'internshipsPage'])->name('internships');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{blog}', [PageController::class, 'blogDetail'])->name('blog.detail');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::post('/internship/apply', [PageController::class, 'applyInternship'])->name('internship.apply');
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
// STUDENT (authenticated)
// ══════════════════════════════════════════
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'studentDashboard'])->name('dashboard');

    // Enrollment & Payment
    Route::get('/enroll/{course}', [EnrollmentController::class, 'enroll'])->name('enroll');
    Route::post('/enrollment/{enrollment}/utr', [EnrollmentController::class, 'submitUtr'])->name('enrollment.utr');

    // Razorpay (AJAX)
    Route::post('/payment/razorpay/create', [PaymentController::class, 'createRazorpayOrder'])->name('payment.razorpay.create');
    Route::post('/payment/razorpay/verify', [PaymentController::class, 'verifyRazorpayPayment'])->name('payment.razorpay.verify');

    // Reviews
    Route::post('/course/{course}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

// ══════════════════════════════════════════
// TRAINER
// ══════════════════════════════════════════
Route::middleware(['auth', 'role:trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'trainerDashboard'])->name('dashboard');
});

// ══════════════════════════════════════════
// ADMIN
// ══════════════════════════════════════════
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Users
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::post('/users/{user}/approve', [AdminController::class, 'approveTrainer'])->name('users.approve');
    Route::post('/users/{user}/role', [AdminController::class, 'changeRole'])->name('users.role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Courses
    Route::get('/courses', [AdminController::class, 'courses'])->name('courses');
    Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
    Route::post('/courses', [AdminController::class, 'storeCourse'])->name('courses.store');
    Route::get('/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('courses.edit');
    Route::put('/courses/{course}', [AdminController::class, 'updateCourse'])->name('courses.update');
    Route::delete('/courses/{course}', [AdminController::class, 'deleteCourse'])->name('courses.delete');

    // Enrollments
    Route::get('/enrollments', [AdminController::class, 'enrollments'])->name('enrollments');
    Route::post('/enrollments/{enrollment}/verify', [AdminController::class, 'verifyEnrollment'])->name('enrollments.verify');
    Route::delete('/enrollments/{enrollment}', [AdminController::class, 'deleteEnrollment'])->name('enrollments.delete');

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

    // Internships
    Route::get('/internships', [AdminController::class, 'internships'])->name('internships');
    Route::post('/internships/{application}/status', [AdminController::class, 'updateInternshipStatus'])->name('internships.status');

    // Reviews
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/approve', [AdminController::class, 'approveReview'])->name('reviews.approve');
    Route::post('/reviews/{review}/reject', [AdminController::class, 'rejectReview'])->name('reviews.reject');

    // Subscribers
    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');
});

// ══════════════════════════════════════════
// WEBHOOKS (no auth)
// ══════════════════════════════════════════
Route::post('/webhook/payment', [PaymentController::class, 'paymentWebhook'])->name('webhook.payment');
