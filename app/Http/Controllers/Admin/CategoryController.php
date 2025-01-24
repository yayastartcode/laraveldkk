<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function index()
    {
        $perPage = 10;
        $page = request()->get('page', 1);
        $skip = ($page - 1) * $perPage;

        $pipeline = [
            [
                '$lookup' => [
                    'from' => 'blogs',
                    'localField' => '_id',
                    'foreignField' => 'category_id',
                    'as' => 'blogs'
                ]
            ],
            [
                '$project' => [
                    '_id' => 1,
                    'name' => 1,
                    'slug' => 1,
                    'description' => 1,
                    'blogs_count' => ['$size' => '$blogs']
                ]
            ]
        ];

        $categories = Category::raw(function($collection) use ($pipeline, $skip, $perPage) {
            return $collection->aggregate(array_merge($pipeline, [
                ['$skip' => $skip],
                ['$limit' => $perPage]
            ]))->toArray();
        });

        // Convert MongoDB documents to arrays
        $categories = array_map(function($category) {
            return [
                '_id' => (string) $category['_id'],
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'] ?? '',
                'blogs_count' => $category['blogs_count']
            ];
        }, $categories);

        $total = Category::raw(function($collection) use ($pipeline) {
            $countPipeline = array_merge($pipeline, [['$count' => 'total']]);
            $result = $collection->aggregate($countPipeline)->toArray();
            return isset($result[0]) ? $result[0]['total'] : 0;
        });

        $categories = new LengthAwarePaginator(
            $categories,
            $total,
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query()
            ]
        );

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:mongodb.categories,name',
            'description' => 'nullable|string'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        
        $request->validate([
            'name' => 'required|string|max:255|unique:mongodb.categories,name,'.$id.',_id',
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
