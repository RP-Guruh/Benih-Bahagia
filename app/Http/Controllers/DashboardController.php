<?php

namespace App\Http\Controllers;

use App\Models\HasilSkrinning;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Video;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswaDiSkrinning = $this->totalSiswaSkrinning();
        $totalSiswaDiSkrinning7hari = $this->totalAnakSkrinning7Hari();
        $topTen = $this->topTenSkrinning();
        $topTenRegister = $this->topTenRegister();
        $totalVideo = $this->totalVideo();
        $totalArtikel = $this->totalArticle();
        return view("dashboard.dashboard", compact("totalSiswaDiSkrinning", "totalSiswaDiSkrinning7hari", "topTen", "topTenRegister", "totalVideo", "totalArtikel"));
    }

    private function totalSiswaSkrinning()
    {

        if (Auth::user()->level_id != 3 || Auth::user()->level_id != 1) {
            $totalSiswaSkrinning = HasilSkrinning::count();
        } else {
            $totalSiswaSkrinning = HasilSkrinning::where("user_id", Auth::id())->count();
        }
        return $totalSiswaSkrinning;

    }

    private function totalAnakSkrinning7Hari()
    {
        $startDate = now()->subDays(7);
        $endDate = now();

        if (Auth::user()->level_id == 3 || Auth::user()->level_id == 1) {

            return HasilSkrinning::whereBetween('created_at', [$startDate, $endDate])->count();
        }


        return HasilSkrinning::where('user_id', Auth::id())
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    }



    public function anakByAge(Request $request)
    {
        $periode = $request->get('periode', 'this_month');
        $query = HasilSkrinning::query();

        // filter user_id kecuali admin (1,3)
        if (!in_array(Auth::user()->level_id, [1, 3])) {
            $query->where('user_id', Auth::id());
        }

        // filter by periode
        if ($periode === 'this_month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        } elseif ($periode === 'last_month') {
            $lastMonth = now()->subMonth();
            $query->whereMonth('created_at', $lastMonth->month)
                ->whereYear('created_at', $lastMonth->year);
        }

        // ambil data berdasarkan usia (bulan)
        $data = $query->selectRaw('usia_pembulatan, COUNT(*) as total')
            ->groupBy('usia_pembulatan')
            ->orderBy('usia_pembulatan')
            ->get();

        return response()->json($data);
    }

    public function topTenSkrinning()
    {
        $query = HasilSkrinning::query();
        $query->with('formulir');

        if (!in_array(Auth::user()->level_id, [1, 3])) {
            $query->where('user_id', Auth::id());
        }

        $topTen = $query->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return $topTen;
    }

    public function topTenRegister()
    {
        $query = User::query();

        $topTen = $query->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return $topTen;
    }


    public function totalArticle()
    {
        return Article::count();
    }

    public function totalVideo()
    {
        return Video::count();
    }



}
