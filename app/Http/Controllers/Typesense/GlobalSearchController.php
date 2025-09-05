<?php

namespace App\Http\Controllers\Typesense;

use Illuminate\Http\Request;
use App\Services\TypesenseService;
use App\Http\Controllers\Controller;

class GlobalSearchController extends Controller
{
    protected $typesense;

    public function __construct(TypesenseService $typesense)
    {
        $this->typesense = $typesense;
    }

    public function search(Request $request)
    {
       
        $query = $request->input('q', '');

        // Search di Menu
        $menuResults = $this->typesense->search('menus', [
            'q' => $query,
            'query_by' => 'name,code',
        ]);

        // Search di Action
        $actionResults = $this->typesense->search('actions', [
            'q' => $query,
            'query_by' => 'name,code',
        ]);

        return response()->json([
            'menus' => $menuResults['hits'] ?? [],
            'actions' => $actionResults['hits'] ?? [],
        ]);
    }
}
