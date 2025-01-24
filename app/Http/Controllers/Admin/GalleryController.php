<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MongoDB\BSON\ObjectId;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::raw(function($collection) {
            $cursor = $collection->find([], ['sort' => ['order' => 1]]);
            $items = [];
            foreach ($cursor as $document) {
                $items[] = [
                    '_id' => (string)$document->_id,
                    'title' => $document->title ?? '',
                    'description' => $document->description ?? '',
                    'image' => $document->image ?? '',
                    'category' => $document->category ?? '',
                    'order' => (int)($document->order ?? 0),
                    'is_active' => (bool)($document->is_active ?? true)
                ];
            }
            return array_map(function($item) {
                return (object)$item;
            }, $items);
        });
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category' => 'required|string|max:50',
                'is_active' => 'boolean'
            ]);

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('galleries', 'public');
                $validated['image'] = $path;
            }

            $validated['order'] = Gallery::raw(function($collection) {
                $lastGallery = $collection->findOne([], ['sort' => ['order' => -1]]);
                return $lastGallery ? ((int)$lastGallery->order + 1) : 1;
            });
            $validated['is_active'] = $request->has('is_active');

            Gallery::raw(function($collection) use ($validated) {
                $collection->insertOne($validated);
            });

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery item created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create gallery item: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::raw(function($collection) use ($id) {
            $document = $collection->findOne(['_id' => new ObjectId($id)]);
            if (!$document) return null;

            return (object)[
                '_id' => (string)$document->_id,
                'title' => $document->title ?? '',
                'description' => $document->description ?? '',
                'image' => $document->image ?? '',
                'category' => $document->category ?? '',
                'order' => (int)($document->order ?? 0),
                'is_active' => (bool)($document->is_active ?? true)
            ];
        });

        if (!$gallery) {
            return redirect()->route('admin.galleries.index')
                ->with('error', 'Gallery item not found.');
        }

        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category' => 'required|string|max:50',
                'is_active' => 'boolean'
            ]);

            if ($request->hasFile('image')) {
                $gallery = Gallery::raw(function($collection) use ($id) {
                    return $collection->findOne(['_id' => new ObjectId($id)]);
                });
                if ($gallery && $gallery->image) {
                    Storage::disk('public')->delete($gallery->image);
                }

                $path = $request->file('image')->store('galleries', 'public');
                $validated['image'] = $path;
            }

            $validated['is_active'] = $request->has('is_active');

            Gallery::raw(function($collection) use ($id, $validated) {
                $collection->updateOne(
                    ['_id' => new ObjectId($id)],
                    ['$set' => $validated]
                );
            });

            return redirect()->route('admin.galleries.index')
                ->with('success', 'Gallery item updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update gallery item: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $gallery = Gallery::raw(function($collection) use ($id) {
                return $collection->findOne(['_id' => new ObjectId($id)]);
            });

            if ($gallery) {
                if ($gallery->image) {
                    Storage::disk('public')->delete($gallery->image);
                }

                Gallery::raw(function($collection) use ($id) {
                    $collection->deleteOne(['_id' => new ObjectId($id)]);
                });

                return redirect()->route('admin.galleries.index')
                    ->with('success', 'Gallery item deleted successfully.');
            }

            return redirect()->route('admin.galleries.index')
                ->with('error', 'Gallery item not found.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete gallery item: ' . $e->getMessage());
        }
    }

    public function updateOrder(Request $request)
    {
        try {
            $items = $request->get('items', []);
            
            foreach ($items as $item) {
                Gallery::raw(function($collection) use ($item) {
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
