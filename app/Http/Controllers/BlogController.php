<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        // Dummy data for blog listing
        $blogs = [
            [
                'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
                'title' => 'The Importance of Regular Vehicle Maintenance',
                'excerpt' => 'Learn why regular maintenance is crucial for your vehicle\'s longevity and performance.',
                'content' => 'Full article content here...',
                'date' => '2024-01-15',
                'slug' => 'importance-of-regular-vehicle-maintenance'
            ],
            // Add more blog posts here
        ];

        return view('blog.index', compact('blogs'));
    }

    public function show($slug)
    {
        // Dummy data for single blog post
        $blog = [
            'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?q=80&w=2069&auto=format&fit=crop',
            'title' => 'The Importance of Regular Vehicle Maintenance',
            'content' => 'Full article content here...',
            'date' => '2024-01-15',
            'slug' => 'importance-of-regular-vehicle-maintenance'
        ];

        return view('blog.show', compact('blog'));
    }
}
