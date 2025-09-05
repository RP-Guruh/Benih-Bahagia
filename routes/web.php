<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Setting\{MenuController,MenuActionController};
use App\Http\Controllers\Typesense\{GlobalSearchController};
use App\Http\Controllers\HakAkses\{LevelController, LevelPermissionController};
use Illuminate\Support\Facades\Route;



Route::get('/', [App\Http\Controllers\LandingPage\LandingController::class, 'index'])->name('landing_page');

Route::middleware('auth')->group(function () {
    // Route::get('/', function () {
    //     return view('dashboard.dashboard');
    // });

    Route::get('/test', [TestController::class, 'index'])->middleware('can-access:test,view');
    Route::get('/global-search', [GlobalSearchController::class, 'search']);



    Route::prefix('settings')->group(function () {
        Route::get('menu/datatable', [MenuController::class, 'datatable'])->name('settings.menu.datatable');
        Route::resource('menu', MenuController::class)->names('settings.menu');
        Route::get('menu_action/datatable', [MenuActionController::class, 'datatable'])->name('settings.menu_action.datatable');
        Route::resource('menu_action', MenuActionController::class)->names('settings.menu_action');
    });

    Route::prefix('access')->group(function () {
        Route::get('level/datatable', [LevelController::class, 'datatable'])->name('access.level.datatable');
        Route::resource('level', LevelController::class)->names('access.level');

        Route::get('permission/datatable', [LevelPermissionController::class, 'datatable'])->name('access.permission.datatable');
        Route::resource('permission', LevelPermissionController::class)->names('access.permission');
    });

});

require __DIR__ . '/auth.php';
