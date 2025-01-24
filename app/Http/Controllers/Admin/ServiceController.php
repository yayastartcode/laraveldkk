<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all(); 
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'icon' => 'required|string|max:50',
                'order' => 'required|integer|min:0',
                'is_active' => 'boolean'
            ]);

            $data = $request->except('image');
            $data['is_active'] = $request->boolean('is_active', true);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                
                // Ensure directory exists
                $directory = 'services';
                if (!Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                // Store image
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs($directory, $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image file');
                }
                
                $data['image'] = $path;
                
                // Create service using our custom create method
                $service = Service::create($data);
                
                return redirect()
                    ->route('admin.services.index')
                    ->with('success', 'Service created successfully.');
            }

            throw new \Exception('Invalid image file');
            
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to create service: ' . $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return redirect()->route('admin.services.index')->withErrors(['error' => 'Service not found']);
        }
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        try {
            $service = Service::find($id);
            if (!$service) {
                throw new \Exception('Service not found');
            }

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'icon' => 'required|string|max:50',
                'order' => 'required|integer|min:0',
                'is_active' => 'boolean'
            ]);

            $data = $request->except('image');
            $data['is_active'] = $request->boolean('is_active', true);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $file = $request->file('image');
                
                // Delete old image
                if ($service->image && Storage::disk('public')->exists($service->image)) {
                    Storage::disk('public')->delete($service->image);
                }

                // Store new image
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('services', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Failed to store image file');
                }
                
                $data['image'] = $path;
            }

            $service->update($data);
            
            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'Failed to update service: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            $service = Service::find($id);
            if (!$service) {
                throw new \Exception('Service not found');
            }

            // Delete image
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }

            $service->delete();
            
            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service deleted successfully.');
                
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'Failed to delete service: ' . $e->getMessage()]);
        }
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|string',
            'items.*.order' => 'required|integer|min:0'
        ]);

        Service::updateOrder($request->items);

        return response()->json(['success' => true]);
    }
}
