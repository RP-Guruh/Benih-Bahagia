<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Skrining</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; font-size: 14px; line-height: 1.4; margin: 3px; }
        h2, h4, h5 { margin: 0.5em 0; }
        .text-primary { color: #0d6efd; }
        .text-secondary { color: #6c757d; }
        .badge { padding: 0.25em 0.5em; border-radius: 0.25rem; color: white; font-size: 0.85em; }
        .bg-success { background-color: #198754; }
        .bg-danger { background-color: #dc3545; }
        .bg-info { background-color: #0dcaf0; color: #000; }
        .bg-secondary { background-color: #6c757d; }
        table { width: 100%; border-collapse: collapse; margin-top: 1em;  }
        th, td { border: 1px solid #dee2e6; padding: 0.5em; text-align: center; vertical-align: middle; word-wrap: break-word; }
        th { background-color: #cfe2ff; }
        td img { max-height: 200px; object-fit: contain; display: block; margin: auto; }
        footer { font-size: 11px; text-align: center; margin-top: 20px; color: #555; }

        /* Halaman dan page break */
        .page-break { page-break-after: always; }
        tr { page-break-inside: avoid; } /* penting supaya baris tabel tidak terpotong */
        thead { display: table-header-group; } /* header tabel muncul di setiap halaman */
        tfoot { display: table-footer-group; } /* footer tabel muncul di setiap halaman */
    </style>
</head>
<body>

    <!-- Logo -->
    <div style="text-align: center; margin-bottom: 10px; margin-top: -20px;">
        <img src="{{ public_path('assets/landing_page/images/LogoBenih.png') }}" alt="Logo" style="height: 150px;">
    </div>

    <!-- Header -->
    <h2 class="text-primary" style="text-align: center;">{{ $hasil->formulir->judul }}</h2>
    <hr style="border: 1px solid #0d6efd; margin: 0.5em 0 1em 0;">

    <!-- Info Siswa -->
    <p><strong>Nama Siswa:</strong> {{ $hasil->nama_siswa }}</p>
    <p><strong>Nama Orang Tua:</strong> {{ $hasil->nama_orangtua }}</p>
    <p><strong>Usia:</strong> {{ $hasil->usia_aktual }} ({{ $hasil->usia_pembulatan }} bulan)</p>
  <p><strong>Skrining oleh / Tanggal Skrining:</strong> {{ $hasil->guru?->name ?? '-' }} - {{ $hasil->created_at->translatedFormat('j F Y') }}</p>

    <!-- Jawaban -->
    <h3 class="text-primary mt-4">Kuesioner</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Gambar</th>
                <th>Jawaban</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @php
                $jawaban = json_decode($hasil->jawaban, true) ?? [];
            @endphp
            @foreach($hasil->formulir->pertanyaan as $index => $pertanyaan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left;">{{ $pertanyaan->teks }}</td>
                    <td>
                        @if(!empty($pertanyaan->petunjuk_gambar))
                            <img src="{{ public_path($pertanyaan->petunjuk_gambar) }}" alt="Gambar Petunjuk">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(($jawaban[$pertanyaan->id] ?? '') === 'ya')
                            <span class="badge bg-success">ya</span>
                        @elseif(($jawaban[$pertanyaan->id] ?? '') === 'tidak')
                            <span class="badge bg-danger">tidak</span>
                        @else
                            <span class="badge bg-secondary">-</span>
                        @endif
                    </td>
                    <td>{{ $pertanyaan->kategori }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" align="right"><strong>Sub Total "Ya":</strong></td>
                <td>{{ $hasil->total_ya }}</td>
            </tr>
            <tr>
                <td colspan="4" align="right"><strong>Sub Total "Tidak":</strong></td>
                <td>{{ $hasil->total_tidak }}</td>
            </tr>
            <tr>
                <td colspan="4" align="right"><strong>Total Skor:</strong></td>
                <td>{{ $hasil->total_skor }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Evaluasi -->
    <h3 class="text-primary mt-4">Evaluasi Hasil</h3>
    <p><strong>Total Skor:</strong> {{ $hasil->total_skor }}</p>
    <p><strong>Interpretasi:</strong> {{ $hasil->evaluasi->interpretasi ?? '-' }}</p>

    <!-- Intervensi -->
    <h4>Intervensi</h4>
    @if($hasil->evaluasi && $hasil->evaluasi->intervensiRows->isNotEmpty())
        <ul>
            @foreach($hasil->evaluasi->intervensiRows as $intervensi)
                <li>{{ $intervensi->intervensi }}</li>
            @endforeach
        </ul>
    @else
        <p>-</p>
    @endif

    <!-- Footer -->
    <footer>
        Dokumen ini dibuat secara otomatis oleh sistem produksi Benih Bahagia © 2025.<br>
        <b><i>Harap digunakan dengan bijak sesuai tujuan dan fungsinya</i></b>.
    </footer>

</body>
</html>
