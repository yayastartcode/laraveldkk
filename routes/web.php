<?php

use Illuminate\Support\Facades\Route;
use App\Models\Document;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Test MongoDB Connection
Route::get('/test-mongodb', [TestController::class, 'testMongoDB']);

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Appointment routes
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

// Contact routes
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Admin routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Appointments
    Route::get('appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::patch('appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::delete('appointments/{appointment}', [AdminAppointmentController::class, 'destroy'])->name('appointments.destroy');

    // Contacts
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::patch('contacts/{contact}/status', [AdminContactController::class, 'updateStatus'])->name('contacts.updateStatus');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Blog management
    Route::resource('blogs', AdminBlogController::class);
    Route::post('blogs/upload-image', [AdminBlogController::class, 'uploadImage'])->name('blogs.uploadImage');
    
    // Category management
    Route::resource('categories', CategoryController::class);
    
    // Slider management
    Route::resource('sliders', SliderController::class);
    Route::post('sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.updateOrder');
    
    // Service management
    Route::resource('services', ServiceController::class);
    Route::post('services/update-order', [ServiceController::class, 'updateOrder'])->name('services.updateOrder');
    
    // Gallery management
    Route::resource('galleries', GalleryController::class);
    Route::post('galleries/update-order', [GalleryController::class, 'updateOrder'])->name('galleries.updateOrder');
    
    // Testimonial management
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/update-order', [TestimonialController::class, 'updateOrder'])->name('testimonials.updateOrder');
    
    // Settings routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('/logo', [SettingController::class, 'updateLogo'])->name('updateLogo');
        Route::post('/contact', [SettingController::class, 'updateContact'])->name('updateContact');
        Route::post('/social', [SettingController::class, 'updateSocial'])->name('updateSocial');
        Route::post('/navigation', [SettingController::class, 'updateNavigation'])->name('updateNavigation');
        Route::delete('/navigation/{index}', [SettingController::class, 'removeNavItem'])->name('removeNavItem');
    });
});
