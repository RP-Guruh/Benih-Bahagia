<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Video;
use App\Models\Setting;

class LandingController extends Controller
{
    public function index()
    {
        // Header
        $header = Setting::where('key', 'header')->first();
        $contents['navbar_title'] = $header->title ?? 'Benih Bahagia';
        $contents['navbar_logo']  = $header->logo
            ? asset($header->logo)
            : asset('assets/landing_page/images/logo-cropeed.png');

        // Hero
        $hero = Setting::where('key', 'hero')->first();
        $hero_texts = json_decode($hero->title ?? '{}', true);

        $contents['hero_title']       = $hero_texts['title'] ?? 'Pantau Tumbuh Kembang Anak dengan Mudah';
        $contents['hero_subtitle']    = $hero_texts['subtitle'] ?? 'Aplikasi Benih Bahagia membantu guru memantau perkembangan murid secara digital, menyajikan data perkembangan anak dengan cara yang jelas, terstruktur, dan mudah dipahami.';
        $contents['hero_button_text'] = $hero_texts['button_text'] ?? 'Mulai Sekarang - Gratis';
        $contents['hero_image']       = $hero->logo 
            ? asset($hero->logo) 
            : asset('assets/landing_page/images/3.png');

        $settings = Setting::where('key', 'partner')->first();

        $titleData = json_decode($settings->title ?? '{}', true);
        $logosData = json_decode($settings->logo ?? '[]', true);
        $defaultLogos = [
            'assets/landing_page/images/logo_kemdikbud.png',
            'assets/landing_page/images/logo_kemenkes.png',
            'assets/landing_page/images/logo_uima.png',
            'assets/landing_page/images/logo_berdampak.png',
        ];

        if (empty($logosData) || empty($logosData['logos'])) {
            $logosData = ['logos' => $defaultLogos];
        }
        $contents['partners'] = [
            'title' => $titleData['title'] ?? 'Asosiasi & Kolaborasi',
            'subtitle' => $titleData['subtitle'] ?? 'Didukung oleh Perguruan Tinggi & Lembaga Akademik',
            'description' => $titleData['description'] ?? 'Kolaborasi ini memastikan aplikasi memiliki dasar ilmiah yang kuat.',
            'logos' => $logosData,
        ];

        $settingsFeatures = Setting::where('key', 'features')->first();
        
        $featuresData = json_decode($settingsFeatures->title ?? '{}', true);
        $imageFeatures = json_decode($settingsFeatures->logo ?? '', true);
        
        $defaultFeatures = [
            [
                'icon' => 'fact_check',
                'icon_class' => 'text-primary bg-primary bg-opacity-25',
                'heading' => 'Skrinning',
                'desc' => 'Guru dapat melakukan skrining perkembangan anak dengan mudah menggunakan instrumen digital yang terstruktur dan praktis.'
            ],
            [
                'icon' => 'school',
                'icon_class' => 'text-success bg-success bg-opacity-25',
                'heading' => 'Edukasi',
                'desc' => 'Menyediakan materi edukatif bagi guru dan orang tua untuk mendukung proses tumbuh kembang anak secara optimal.'
            ],
            [
                'icon' => 'support_agent',
                'icon_class' => 'text-warning bg-warning bg-opacity-25',
                'heading' => 'Konsultasi',
                'desc' => 'Fitur konsultasi akan memudahkan guru berkomunikasi dengan ahli atau orang tua, sehingga intervensi dapat dilakukan lebih cepat dan tepat.'
            ],
        ];
        
        
        $contents['features'] = [
            'subtitle' => $featuresData['subtitle'] ?? 'Keunggulan Kami',
            'title' => $featuresData['title'] ?? 'Membantu Guru dalam Memantau Perkembangan Anak',
            'items' => $imageFeatures['features'] ?? $defaultFeatures,
        ];


        // About App
        $settingsAbout = Setting::where('key', 'about_app')->first();
        $aboutData = json_decode($settingsAbout->value ?? '{}', true);

        $contents['about_app'] = [
            'image' => $aboutData['image'] ?? 'assets/landing_page/images/produk-1.png',
            'title' => $aboutData['title'] ?? 'Aplikasi Pemantauan Tumbuh Kembang Anak',
            'description' => $aboutData['description'] ?? 'Aplikasi ini dirancang untuk membantu guru ...',
            'features' => $aboutData['features'] ?? [
                [
                    'title' => 'Mudah Digunakan',
                    'description' => 'Antarmuka sederhana yang memudahkan guru mengisi data perkembangan anak tanpa rumit.'
                ],
                [
                    'title' => 'Berbasis Ilmiah',
                    'description' => 'Dikembangkan dengan instrumen akademik dari dosen dan praktisi pendidikan anak.'
                ],
                [
                    'title' => 'Dukungan Edukasi',
                    'description' => 'Menyediakan materi belajar untuk guru dan orang tua agar lebih memahami tahap tumbuh kembang.'
                ],
                [
                    'title' => 'Konsultasi dengan Ahli',
                    'description' => 'Rencananya fitur konsultasi akan memudahkan komunikasi guru dengan tenaga profesional.',
                    'badge' => 'Soon'
                ],
            ],
        ];
   
        $articles = Article::orderBy("created_at","desc")->limit(8)->get();
        $video = Video::orderBy("created_at","desc")->limit(8)->get();
        return view('landing_page.landing', compact('articles','video', 'contents'));
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
