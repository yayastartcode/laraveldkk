<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testMongoDB()
    {
        try {
            // Test settings
            Setting::setByKey('contact_email', 'test@example.com', 'text', 'contact');
            Setting::setByKey('contact_phone', '+1234567890', 'text', 'contact');
            Setting::setByKey('address', '123 Test Street, Test City', 'text', 'contact');
            Setting::setByKey('social_media', [
                'facebook' => 'https://facebook.com/test',
                'instagram' => 'https://instagram.com/test',
                'youtube' => 'https://youtube.com/test'
            ], 'json', 'social');

            // Get settings
            $settings = Setting::getSettings();

            return response()->json([
                'success' => true,
                'message' => 'Test data created successfully',
                'settings' => $settings
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
