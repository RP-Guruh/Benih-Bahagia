<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ArticleController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'content/article');
    }

        public function index()
    {
        return view('content.article.index');
    }

    public function datatable(Request $request)
    {
        $query = Article::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('content.article.show', $row->id);
                $editUrl = route('content.article.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        $categories = Category::all();
        return view('content.article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:articles,title',
            'slug'        => 'required|string|max:255|unique:articles,slug',
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $path = null;
            if ($request->hasFile('thumbnail')) {
                $path = $request->file('thumbnail')->store('article/thumbnail', 'public');
            }

            Article::create([
                'title'       => $validated['title'],
                'slug'        => $validated['slug'],
                'content'     => $validated['content'],
                'thumbnail'   => $path,
                'category_id' => $validated['category_id'],
                'author_id'   => auth()->id(),
            ]);

            return redirect()->route('content.article.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Article created successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating article: '.$e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to create article. Please try again.'
            ]);
        }
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('content.article.edit', compact('article','categories'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255|unique:articles,title,'.$article->id,
            'slug'        => 'required|string|max:255|unique:articles,slug,'.$article->id,
            'content'     => 'required|string',
            'thumbnail'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            $path = $article->thumbnail;
            if ($request->hasFile('thumbnail')) {
                if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                    Storage::disk('public')->delete($article->thumbnail);
                }
                $path = $request->file('thumbnail')->store('article/thumbnail', 'public');
            }

            $article->update([
                'title'       => $validated['title'],
                'slug'        => $validated['slug'],
                'content'     => $validated['content'],
                'thumbnail'   => $path,
                'category_id' => $validated['category_id'],
            ]);

            return redirect()->route('content.article.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Article updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating article: '.$e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to update article. Please try again.'
            ]);
        }
    }

    public function show(Article $article)
    {
        return view('content.article.show', compact('article'));
    }

public function uploadImage(Request $request)
{
    if ($request->hasFile('upload')) {
        $request->validate([
            'upload' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB
        ]);

        $file = $request->file('upload');
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;

        // Simpan ke storage/app/public/article/content
        $file->storeAs('article/content', $fileName, 'public');

        // URL untuk CKEditor
        $url = asset('storage/article/content/' . $fileName);

        return response()->json([
            'uploaded' => 1,
            'fileName' => $fileName,
            'url' => $url
        ]);
    }

    return response()->json([
        'uploaded' => 0,
        'error' => ['message' => 'No file uploaded.']
    ]);
}




}