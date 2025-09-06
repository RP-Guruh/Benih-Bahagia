<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Formulir;

class FormulirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Bayi Umur 3 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 0,  'usia_max' => 3,  'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Bayi Umur 6 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 4,  'usia_max' => 6,  'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Bayi Umur 9 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 7,  'usia_max' => 9,  'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Bayi Umur 12 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 10, 'usia_max' => 12, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 15 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 13, 'usia_max' => 15, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 18 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 16, 'usia_max' => 18, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 21 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 19, 'usia_max' => 21, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 24 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 22, 'usia_max' => 24, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 30 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 25, 'usia_max' => 30, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 36 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 31, 'usia_max' => 36, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 42 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 37, 'usia_max' => 42, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 48 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 43, 'usia_max' => 48, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 54 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 49, 'usia_max' => 54, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 60 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 55, 'usia_max' => 60, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 66 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 61, 'usia_max' => 66, 'status' => 'aktif'],
            ['judul' => 'Kuesioner Pra Skrining Perkembangan (KPSP) Anak Umur 72 Bulan', 'jumlah_pertanyaan' => 10, 'usia_min' => 67, 'usia_max' => 72, 'status' => 'aktif'],
        ];

        foreach ($data as $item) {
            Formulir::create($item);
        }
    }
}
