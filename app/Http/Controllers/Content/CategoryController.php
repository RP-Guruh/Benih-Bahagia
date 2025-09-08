<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'content/category');
    }

    public function index()
    {
        return view('content.category.index');
    }

    public function datatable(Request $request)
    {
        $query = Category::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('content.category.show', $row->id);
                $editUrl = route('content.category.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        return view('content.category.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name',
        'slug' => 'required|string|max:255|unique:categories,slug',
    ]);

    try {
        $category = new Category();
        $category->name = $validated['name'];
        $category->slug = \Str::slug($validated['slug']);
        $category->save();

        return redirect()->route('content.category.index')->with('alert', [
            'type' => 'success',
            'title' => 'Success!',
            'message' => 'Category created successfully.'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error creating category: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to create category. Please try again.'
            ]);
    }
    }
    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('content.category.edit', compact('category'))->render();
    }

    public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        'slug' => 'required|string|max:255|unique:categories,slug,' . $category->id,
    ]);

    try {
        $category->name = $validated['name'];
        $category->slug = \Str::slug($validated['slug']);
        $category->save();

        return redirect()->route('content.category.index')->with('alert', [
            'type' => 'success',
            'title' => 'Updated!',
            'message' => 'Category updated successfully.'
        ]);
    } catch (\Exception $e) {
        \Log::error('Error updating category: ' . $e->getMessage());

        return redirect()->back()
            ->withInput()
            ->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to update category. Please try again.'
            ]);
    }
    }

    public function show(Category $category)
    {
        $articles = $category->articles()->latest()->get();
        $videos   = $category->videos()->latest()->get();

        return view('content.category.show', compact('category', 'articles', 'videos'));
    }
}