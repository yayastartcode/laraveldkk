<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = [
            [
                'image' => 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop',
                'title' => 'Professional Auto Services',
                'description' => 'Expert auto repair and maintenance services to keep your vehicle running at its best',
                'buttonText' => 'Contact Us'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=2072&auto=format&fit=crop',
                'title' => 'Expert Karoseri Services',
                'description' => 'Custom vehicle body manufacturing and modifications by skilled professionals',
                'buttonText' => 'Learn More'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1599256872237-5dcc0fbe9668?q=80&w=2071&auto=format&fit=crop',
                'title' => 'Quality Body Repair',
                'description' => 'Professional auto body repair and paint services for all vehicle types',
                'buttonText' => 'Book Now'
            ]
        ];

        $services = [
            [
                'title' => 'Karoseri',
                'image' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?q=80&w=2070&auto=format&fit=crop',
                'description' => 'Specialized in creating custom bodies for trucks, buses, and heavy vehicles. Our expert craftsmen combine functionality with design to deliver superior quality vehicle body solutions.',
                'features' => ['Custom truck bodies', 'Bus body manufacturing', 'Heavy vehicle modifications', 'Quality materials']
            ],
            [
                'title' => 'Engine Maintenance',
                'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?q=80&w=2072&auto=format&fit=crop',
                'description' => 'Comprehensive engine maintenance and repair services to keep your vehicle running at peak performance. From routine maintenance to complex repairs.',
                'features' => ['Engine diagnostics', 'Performance tuning', 'Parts replacement', 'Regular maintenance']
            ],
            [
                'title' => 'Body Repair',
                'image' => 'https://images.unsplash.com/photo-1599256872237-5dcc0fbe9668?q=80&w=2071&auto=format&fit=crop',
                'description' => 'Professional auto body repair services to restore your vehicle\'s appearance and structural integrity. Expert color matching and dent removal.',
                'features' => ['Collision repair', 'Paint services', 'Dent removal', 'Frame straightening']
            ]
        ];

        $blogs = [
            [
                'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'The Importance of Regular Vehicle Maintenance',
                'excerpt' => 'Learn why regular maintenance is crucial for your vehicle\'s longevity and performance.',
                'date' => '2024-01-15',
                'slug' => 'importance-of-regular-vehicle-maintenance'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Understanding Karoseri: A Complete Guide',
                'excerpt' => 'Everything you need to know about custom vehicle body manufacturing and modifications.',
                'date' => '2024-01-10',
                'slug' => 'understanding-karoseri-complete-guide'
            ],
            [
                'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Top 5 Body Repair Myths Debunked',
                'excerpt' => 'We debunk common misconceptions about auto body repair and paint services.',
                'date' => '2024-01-05',
                'slug' => 'top-5-body-repair-myths-debunked'
            ]
        ];

        $gallery = [
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Custom Truck Body',
                'category' => 'Karoseri'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Engine Overhaul',
                'category' => 'Maintenance'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Paint Job',
                'category' => 'Body Repair'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Bus Modification',
                'category' => 'Karoseri'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Collision Repair',
                'category' => 'Body Repair'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Performance Tuning',
                'category' => 'Maintenance'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Custom Interior',
                'category' => 'Karoseri'
            ],
            [
                'url' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'Paint Detailing',
                'category' => 'Body Repair'
            ]
        ];

        $testimonials = [
            [
                'avatar' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'name' => 'John Smith',
                'company' => 'ABC Logistics',
                'quote' => 'The karoseri work done on our fleet trucks was exceptional. The attention to detail and quality of work exceeded our expectations.'
            ],
            [
                'avatar' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'name' => 'Sarah Johnson',
                'company' => 'XYZ Transport',
                'quote' => 'Their engine maintenance service has kept our vehicles running smoothly. Highly professional team and great customer service.'
            ],
            [
                'avatar' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'name' => 'Michael Chen',
                'company' => 'Chen Industries',
                'quote' => 'The body repair work was flawless. They restored our damaged vehicle to its original condition, and the paint match was perfect.'
            ]
        ];

        return view('home', compact('heroSlides', 'services', 'blogs', 'gallery', 'testimonials'));
    }
}
