<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Video;

class LandingController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy("created_at","desc")->limit(8)->get();
        $video = Video::orderBy("created_at","desc")->limit(8)->get();
        return view('landing_page.landing', compact('articles','video'));
    }

    public function article($id) {
        $article = Article::with('author', 'category')->where('id', $id)->first();
        return view('landing_page.article', compact('article'));
    }

    public function list() {
        $articles = Article::latest()->paginate(9); 
        return view('landing_page.article_list', compact('articles'));
    }

    public function video($id)
    {
        $video = Video::with('author', 'category')->where('id', $id)->firstOrFail();
        return view('landing_page.video', compact('video'));
    }
    public function video_list() {
        $videos = Video::latest()->paginate(9); 
        return view('landing_page.video_list', compact('videos'));
    }
}
