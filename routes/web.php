<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\Setting\{MenuController,MenuActionController};
use App\Http\Controllers\Typesense\{GlobalSearchController};
use App\Http\Controllers\HakAkses\{LevelController, LevelPermissionController};
use App\Http\Controllers\MasterData\{FormulirController, PertanyaanController, JawabanController};
use App\Http\Controllers\Content\{ArticleController, CategoryController, VideoController};
use App\Http\Controllers\Skrinning\{SkrinningController};
use App\Http\Controllers\LandingPage\LandingController;
use App\Http\Controllers\User\UserTerdaftarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\SettingLandingController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
   return app(LandingController::class)->index();
});

Route::get('/article/{id}/{slug}', [LandingController::class, 'article'])->name('article.detail');
Route::get('/article', [LandingController::class, 'list'])->name('article.index');

Route::get('/video/{id}/{slug}', [LandingController::class, 'video'])->name('video.detail');
Route::get('/video', [LandingController::class, 'list_video'])->name('video.index');


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return app(DashboardController::class)->index();
    })->name('dashboard');

    Route::get('/dashboard/anak-by-age', [DashboardController::class, 'anakByAge'])->name('dashboard.by.age');


    Route::post('/admin/update-header', [SettingLandingController::class, 'updateHeader'])->name('admin.updateHeader');
    Route::post('/admin/update-hero', [SettingLandingController::class, 'updateHero'])->name('admin.updateHero');
    Route::post('/admin/update-partners-section', [SettingLandingController::class, 'updatePartner'])->name('admin.updatePartner');



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
    
    Route::prefix('masterdata')->group(function () {
        Route::get('formulir/datatable', [FormulirController::class, 'datatable'])->name('masterdata.formulir.datatable');
        Route::resource('formulir', FormulirController::class)->names('masterdata.formulir');
        Route::get('pertanyaan/datatable', [PertanyaanController::class, 'datatable'])->name('masterdata.pertanyaan.datatable');
        Route::resource('pertanyaan', PertanyaanController::class)->names('masterdata.pertanyaan');
        Route::get('jawaban/datatable', [JawabanController::class, 'datatable'])->name('masterdata.jawaban.datatable');
        Route::resource('jawaban', JawabanController::class)->names('masterdata.jawaban');
    });

    Route::prefix('content')->group(function () {
        Route::get('category/datatable', [CategoryController::class, 'datatable'])->name('content.category.datatable');
        Route::resource('category', CategoryController::class)->names('content.category');

        Route::post('article/upload-image', [ArticleController::class, 'uploadImage'])->name('content.article.upload');
        Route::get('article/datatable', [ArticleController::class, 'datatable'])->name('content.article.datatable');
        Route::resource('article', ArticleController::class)->names('content.article');
        
        Route::get('video/datatable', [VideoController::class, 'datatable'])->name('content.video.datatable');
        Route::resource('video', VideoController::class)->names('content.video');
    });

    Route::prefix('skrinning')->group(function () {
        Route::get('siswa/print/{id}', [SkrinningController::class, 'print'])->name('skrinning.siswa.print');
        
        Route::get('siswa/datatable', [SkrinningController::class, 'datatable'])->name('skrinning.siswa.datatable');
        Route::get('siswa/formulir/{usia}', [SkrinningController::class, 'formulir'])->name('skrinning.siswa.formulir');
        
        Route::resource('siswa', SkrinningController::class)->names('skrinning.siswa');

    });

    Route::prefix('user')->group(function () {
        Route::get('terdaftar/datatable', [UserTerdaftarController::class, 'datatable'])->name('user.terdaftar.datatable');
        Route::resource('terdaftar', UserTerdaftarController::class)->names('user.terdaftar');
    });

    Route::resource('change-password', ChangePasswordController::class)->names('change-password');

    
});

require __DIR__ . '/auth.php';
