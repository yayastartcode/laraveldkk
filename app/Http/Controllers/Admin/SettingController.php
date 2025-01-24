<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $logo = Setting::getByKey('site_logo');
        $navigation = Setting::getByKey('navigation', []);
        $contact_email = Setting::getByKey('contact_email');
        $contact_phone = Setting::getByKey('contact_phone');
        $address = Setting::getByKey('address');
        $social_media = Setting::getByKey('social_media', []);
        
        return view('admin.settings.index', compact(
            'logo',
            'navigation',
            'contact_email',
            'contact_phone',
            'address',
            'social_media'
        ));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            $oldLogo = Setting::getByKey('site_logo');
            if ($oldLogo && Storage::exists('public/' . $oldLogo)) {
                Storage::delete('public/' . $oldLogo);
            }

            // Store new logo
            $path = $request->file('logo')->store('logos', 'public');
            Setting::setByKey('site_logo', $path, 'file', 'general');

            return redirect()->route('admin.settings.index')
                ->with('success', 'Logo updated successfully.');
        }

        return back()->with('error', 'No logo file uploaded.');
    }

    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'address' => 'required|string|max:500'
        ]);

        Setting::setByKey('contact_email', $request->contact_email, 'text', 'contact');
        Setting::setByKey('contact_phone', $request->contact_phone, 'text', 'contact');
        Setting::setByKey('address', $request->address, 'text', 'contact');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Contact information updated successfully.');
    }

    public function updateSocial(Request $request)
    {
        $request->validate([
            'social_media' => 'required|array',
            'social_media.facebook' => 'nullable|url',
            'social_media.instagram' => 'nullable|url',
            'social_media.youtube' => 'nullable|url'
        ]);

        $socialMedia = array_filter($request->social_media, fn($url) => !empty($url));
        Setting::setByKey('social_media', $socialMedia, 'json', 'social');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Social media links updated successfully.');
    }

    public function updateNavigation(Request $request)
    {
        $request->validate([
            'navigation' => 'required|array',
            'navigation.*.label' => 'required|string|max:255',
            'navigation.*.url' => 'required|string|max:255',
            'navigation.*.order' => 'required|integer'
        ]);

        $navigation = collect($request->navigation)
            ->sortBy('order')
            ->values()
            ->toArray();

        Setting::setByKey('navigation', $navigation, 'json', 'navigation');

        return redirect()->route('admin.settings.index')
            ->with('success', 'Navigation updated successfully.');
    }

    public function removeNavItem($index)
    {
        $navigation = Setting::getByKey('navigation', []);
        
        if (isset($navigation[$index])) {
            unset($navigation[$index]);
            $navigation = array_values($navigation); // Reindex array
            Setting::setByKey('navigation', $navigation, 'json', 'navigation');
            
            return redirect()->route('admin.settings.index')
                ->with('success', 'Navigation item removed successfully.');
        }

        return back()->with('error', 'Navigation item not found.');
    }
}
