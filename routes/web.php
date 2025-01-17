<?php

use Illuminate\Support\Facades\Route;
use App\Models\Document;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\BlogController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Appointment routes
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

// Contact routes
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Newsletter routes
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// MongoDB test route
Route::get('/test-mongodb', function() {
    try {
        $document = new Document();
        $document->name = "Test Document";
        $document->save();
        return "Document created successfully!";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});
