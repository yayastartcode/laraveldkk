<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::raw(function($collection) {
            return $collection->find([], ['sort' => ['order' => 1]])->toArray();
        });
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'content' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'required|integer|min:1|max:5',
                'is_active' => 'boolean'
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('testimonials', 'public');
                $validated['image'] = $path;
            }

            $validated['order'] = Testimonial::raw(function($collection) {
                $lastTestimonial = $collection->findOne([], ['sort' => ['order' => -1]]);
                return $lastTestimonial ? ($lastTestimonial->order + 1) : 1;
            });
            $validated['is_active'] = $request->has('is_active');

            Testimonial::raw(function($collection) use ($validated) {
                $collection->insertOne($validated);
            });

            return redirect()->route('admin.testimonials.index')
                ->with('success', 'Testimonial created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating testimonial: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find(new ObjectId($id));

        if (!$testimonial) {
            return redirect()->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                'company' => 'nullable|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'required|integer|min:1|max:5',
                'is_active' => 'boolean'
            ]);

            if ($request->hasFile('image')) {
                $testimonial = Testimonial::find(new ObjectId($id));
                if ($testimonial && $testimonial->image) {
                    Storage::disk('public')->delete($testimonial->image);
                }

                $path = $request->file('image')->store('testimonials', 'public');
                $validated['image'] = $path;
            }

            $validated['is_active'] = $request->has('is_active');

            Testimonial::raw(function($collection) use ($id, $validated) {
                $collection->updateOne(
                    ['_id' => new ObjectId($id)],
                    ['$set' => $validated]
                );
            });

            return redirect()->route('admin.testimonials.index')
                ->with('success', 'Testimonial updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating testimonial: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::find(new ObjectId($id));

            if ($testimonial) {
                if ($testimonial->image) {
                    Storage::disk('public')->delete($testimonial->image);
                }

                Testimonial::raw(function($collection) use ($id) {
                    $collection->deleteOne(['_id' => new ObjectId($id)]);
                });

                return redirect()->route('admin.testimonials.index')
                    ->with('success', 'Testimonial deleted successfully.');
            }

            return redirect()->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting testimonial: ' . $e->getMessage());
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $items = $request->get('items', []);
            
            foreach ($items as $item) {
                Testimonial::raw(function($collection) use ($item) {
                    $collection->updateOne(
                        ['_id' => new ObjectId($item['id'])],
                        ['$set' => ['order' => (int)$item['order']]]
                    );
                });
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
