<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\PermissionHelper;
use App\Models\Jawaban;

class JawabanController extends Controller
{
    public function __construct()
    {
        PermissionHelper::apply($this, 'masterdata/jawaban');
    }

}