<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::getActiveSliders();
        $services = Service::getActiveServices();
        $gallery = Gallery::getActiveGalleries();
        $testimonials = Testimonial::where('is_active', true)->orderBy('order')->get();
        
        // Get all settings including logo
        $settings = Setting::getSettings();

        $blogs = [
            [
                'title' => 'The Future of Karoseri',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=2070&auto=format&fit=crop',
                'date' => '2024-01-15',
                'excerpt' => 'Discover the latest trends and innovations in the karoseri industry.',
                'author' => 'John Doe',
                'slug' => 'future-of-karoseri'
            ],
            [
                'title' => 'Innovations in Vehicle Body Design',
                'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'date' => '2024-01-10',
                'excerpt' => 'Learn about the latest innovations in vehicle body design and manufacturing.',
                'author' => 'Jane Smith',
                'slug' => 'innovations-vehicle-body-design'
            ],
            [
                'title' => 'Maintaining Your Commercial Vehicle',
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop',
                'date' => '2024-01-05',
                'excerpt' => 'Essential tips for maintaining your commercial vehicle in top condition.',
                'author' => 'Mike Johnson',
                'slug' => 'maintaining-commercial-vehicle'
            ]
        ];

        return view('home', compact(
            'sliders',
            'services',
            'gallery',
            'testimonials',
            'blogs',
            'settings'
        ));
    }
}
