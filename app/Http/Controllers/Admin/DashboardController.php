<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentAppointments = Appointment::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $recentContacts = Contact::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        $totalAppointments = Appointment::count();
        $totalContacts = Contact::count();
        $totalBlogs = Blog::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact(
            'recentAppointments',
            'recentContacts',
            'totalAppointments',
            'totalContacts',
            'totalBlogs',
            'totalCategories'
        ));
    }
}
