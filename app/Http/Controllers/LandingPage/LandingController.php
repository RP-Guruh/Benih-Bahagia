<?php

namespace App\Http\Controllers\LandingPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing_page.app_landing');
    }
}
