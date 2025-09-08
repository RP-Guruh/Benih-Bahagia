<?php

namespace App\Http\Controllers\Content;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Video;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VideoController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'content/video');
    }

    public function index()
    {
        return view('content.video.index');
    }

    public function datatable(Request $request)
    {
        $query = Video::query();


        if ($request->filled('keyword')) {
            $search = $request->keyword;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('youtube_url', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $showUrl = route('content.video.show', $row->id);
                $editUrl = route('content.video.edit', $row->id);
                return view('datatable.actions_table', compact('row', 'showUrl', 'editUrl'))->render();
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create() {
        $categories = Category::all();
        return view('content.video.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:videos,title',
            'youtube_url'  => 'required|url',
            'description'  => 'nullable|string',
            'category_id'  => 'required|exists:categories,id',
        ]);

        try {
            $video = new Video();
            $video->title       = $validated['title'];
            $video->slug        = Str::slug($validated['title']);
            $video->youtube_url = $validated['youtube_url'];
            $video->description = $validated['description'] ?? null;
            $video->category_id = $validated['category_id'];
            $video->author_id   = Auth::id();
            $video->save();

            return redirect()->route('content.video.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Video created successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error creating video: '.$e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to create video. Please try again.'
            ]);
        }
    }

    public function edit(Video $video)
    {
        $categories = Category::all();
        return view('content.video.edit', compact('video', 'categories'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255|unique:videos,title,' . $video->id,
            'youtube_url'  => 'required|url',
            'description'  => 'nullable|string',
            'category_id'  => 'required|exists:categories,id',
        ]);

        try {
            $video->title       = $validated['title'];
            $video->slug        = Str::slug($validated['title']);
            $video->youtube_url = $validated['youtube_url'];
            $video->description = $validated['description'] ?? null;
            $video->category_id = $validated['category_id'];
            $video->author_id   = Auth::id();
            $video->save();

            return redirect()->route('content.video.index')->with('alert', [
                'type' => 'success',
                'title' => 'Success!',
                'message' => 'Video updated successfully.'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating video: '.$e->getMessage());

            return redirect()->back()->withInput()->with('alert', [
                'type' => 'danger',
                'title' => 'Failed!',
                'message' => 'Failed to update video. Please try again.'
            ]);
        }
    }

    public function show(Video $video)
    {
        $video->load('category', 'author');
        return view('content.video.show', compact('video'));
    }
}