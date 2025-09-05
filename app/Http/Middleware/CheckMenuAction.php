<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMenuAction
{
    public function handle(Request $request, Closure $next, $menuCode, $actionCode): Response
    {
        $user = $request->user();

     
        $hasAccess = $user->menuActions()
            ->whereHas('menu', fn($q) => $q->where('code', $menuCode))
            ->whereHas('action', fn($q) => $q->where('code', $actionCode))
            ->exists();
        
        if (!$hasAccess) {
            abort(403, "Anda tidak punya akses ke [$menuCode:$actionCode]");
        }

        return $next($request);
    }
}
