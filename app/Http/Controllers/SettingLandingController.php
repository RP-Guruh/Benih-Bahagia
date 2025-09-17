<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingLandingController extends Controller
{
    public function updateHeader(Request $request)
    {
        if (!in_array(auth()->user()->level_id, [1, 3])) {
            abort(403, 'Unauthorized action.');
        }

        $settings = Setting::firstOrCreate(['key' => 'header']);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('assets/landing_page/images_editable'), $filename);

            $settings->logo = 'assets/landing_page/images_editable/' . $filename;
        }

        if ($request->title) {
            $settings->title = $request->title;
        }

        $settings->save();

        return response()->json([
            'title' => $settings->title,
            'logo_url' => $settings->logo
                ? asset($settings->logo)
                : asset('assets/landing_page/images/logo-cropeed.png'),
        ]);
    }

    public function updateHero(Request $request)
    {
        if (!in_array(auth()->user()->level_id, [1, 3])) {
            abort(403, 'Unauthorized action.');
        }

        $settings = Setting::firstOrCreate(['key' => 'hero']);

        // Bersihkan teks: trim dan hilangkan line break
        $texts = [
            'title' => trim(str_replace(["\r", "\n"], ' ', $request->hero_title)),
            'subtitle' => trim(str_replace(["\r", "\n"], ' ', $request->hero_subtitle)),
            'button_text' => trim(str_replace(["\r", "\n"], ' ', $request->hero_button_text)),
        ];

        $settings->title = json_encode($texts);

        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $destination = public_path('assets/landing_page/images_editable');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }

            $file->move($destination, $filename);

            $settings->logo = 'assets/landing_page/images_editable/' . $filename;
        }

        $settings->save();

        return response()->json([
            'hero_title' => $texts['title'],
            'hero_subtitle' => $texts['subtitle'],
            'hero_button_text' => $texts['button_text'],
            'hero_image_url' => $settings->logo ? asset('storage/' . $settings->logo) : null,
        ]);
    }

public function updatePartner(Request $request)
{
    if (!in_array(auth()->user()->level_id, [1,3])) {
        abort(403, 'Unauthorized action.');
    }

    $settings = Setting::firstOrCreate(['key' => 'partner']);

    $title       = trim(str_replace(["\r","\n"], ' ', $request->section_title));
    $subtitle    = trim(str_replace(["\r","\n"], ' ', $request->section_subtitle));
    $description = trim(str_replace(["\r","\n"], ' ', $request->section_description));

    $defaultLogos = [
        'assets/landing_page/images/logo_kemdikbud.png',
        'assets/landing_page/images/logo_kemenkes.png',
        'assets/landing_page/images/logo_uima.png',
        'assets/landing_page/images/logo_berdampak.png',
    ];

    $logos = ['logos' => []];

    if ($request->input('reset') == 1) {
        $logos['logos'] = $defaultLogos;
    } 
    else {
        if ($request->has('old_logos')) {
            foreach ($request->old_logos as $path) {
                if ($path) {
                    $logos['logos'][] = $path;
                }
            }
        }

        if ($request->hasFile('logos')) {
            foreach ($request->file('logos') as $index => $file) {
                if ($file) {
                    $filename    = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path('assets/landing_page/images_editable');

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);

                    $logos['logos'][$index] = 'assets/landing_page/images_editable/' . $filename;
                }
            }
        }

        if ($request->hasFile('new_logos')) {
            foreach ($request->file('new_logos') as $file) {
                if ($file) {
                    $filename    = time() . '_' . $file->getClientOriginalName();
                    $destination = public_path('assets/landing_page/images_editable');

                    if (!file_exists($destination)) {
                        mkdir($destination, 0755, true);
                    }

                    $file->move($destination, $filename);
                    $logos['logos'][] = 'assets/landing_page/images_editable/' . $filename;
                }
            }
        }

        if (empty($logos['logos'])) {
            $logos['logos'] = $defaultLogos;
        }
    }

    $settings->title = json_encode([
        'title'       => $title ?: 'Asosiasi & Kolaborasi',
        'subtitle'    => $subtitle ?: 'Didukung oleh Perguruan Tinggi & Lembaga Akademik',
        'description' => $description ?: 'Kolaborasi ini memastikan aplikasi memiliki dasar ilmiah yang kuat.',
    ], JSON_UNESCAPED_UNICODE);

    $settings->logo = json_encode($logos, JSON_UNESCAPED_UNICODE);
    $settings->save();

    return response()->json([
        'title'       => $title,
        'subtitle'    => $subtitle,
        'description' => $description,
        'logos'       => collect($logos['logos'])->map(fn($p) => asset($p) . '?v=' . time()),
    ]);
}




}