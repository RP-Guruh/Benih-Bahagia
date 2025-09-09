@extends('app')

@section('content')
<div class="card bg-white border-0 rounded-3 mb-4 shadow-sm">
    <div class="card-body p-4">
        <!-- Judul Formulir -->
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-2 text-primary">{{ $hasil->formulir->judul }}</h1>
            <hr class="mx-auto rounded" style="width: 190px; height: 4px; background-color: #0d6efd; border: none;">
        </div>

        <!-- Info Siswa & Usia -->
       <!-- Info Siswa & Usia -->
<div class="row g-4 mb-4 align-items-start">
    <!-- Kolom 1: Info Siswa -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="p-3 rounded bg-white border shadow-md card">
            <h4 class="fw-semibold mb-3">Info Siswa</h4>
            <p class="mb-2"><i class="bi bi-person-fill me-2 text-primary"></i> <strong>Nama Siswa:</strong> <span class="text-secondary">{{ $hasil->nama_siswa }}</span></p>
            <p class="mb-2"><i class="bi bi-people-fill me-2 text-primary"></i> <strong>Nama Orang Tua:</strong> <span class="text-secondary">{{ $hasil->nama_orangtua }}</span></p>
            <p class="mb-2"><i class="bi bi-calendar-fill me-2 text-primary"></i> <strong>Tanggal Lahir:</strong> <span class="text-secondary">{{ \Carbon\Carbon::parse($hasil->tanggal_lahir)->translatedFormat('j F Y') }}</span></p>
        </div>
    </div>

    <!-- Kolom 2: Usia & Tanggal Skrining -->
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="p-3 rounded bg-white border shadow-md card">
            <h4 class="fw-semibold mb-3">Usia & Skrining</h4>
            <p class="mb-2"><strong>Usia Aktual:</strong> <span class="text-secondary">{{ $hasil->usia_aktual }}</span></p>
            <p class="mb-2"><strong>Usia Pembulatan:</strong> <span class="text-secondary">{{ $hasil->usia_pembulatan }} bulan</span></p>
          <p class="mb-2">
                <strong>Dibuat / Tanggal Skrining:</strong> 
                <span class="text-secondary">
                    {{ $hasil->guru->name ?? '-' }} - {{ $hasil->created_at->translatedFormat('j F Y') }}
                </span>
            </p>

        </div>
    </div>
</div>


        <!-- Tabel Jawaban -->
        <div class="default-table-area style-two default-table-width">
        <div class="table-responsive mb-4">
            <table class="table table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Bobot</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $jawaban = json_decode($hasil->jawaban, true) ?? [];
                    @endphp
                    @foreach($hasil->formulir->pertanyaan as $index => $pertanyaan)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-secondary fw-medium" style="max-width: 400px; word-wrap: break-word;">
                                {{ $pertanyaan->teks }}
                                 <img src="/{{ $pertanyaan->petunjuk_gambar }}" 
                                 class="img-fluid rounded" 
                                 style="max-height:200px; object-fit:contain;">
                            </td>
                            <td class="text-center">
                                @if(($jawaban[$pertanyaan->id] ?? '') === 'ya')
                                    <span class="badge bg-success">ya</span>
                                @elseif(($jawaban[$pertanyaan->id] ?? '') === 'tidak')
                                    <span class="badge bg-danger">tidak</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $pertanyaan->bobot_nilai }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-end fw-medium">Sub Total "Ya":</td>
                        <td class="text-center fw-medium">{{ $hasil->total_ya }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-medium">Sub Total "Tidak":</td>
                        <td class="text-center fw-medium">{{ $hasil->total_tidak }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-end fw-bold">Total Skor:</td>
                        <td class="text-center fw-bold">{{ $hasil->total_skor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>

        <!-- Evaluasi Hasil -->
        <div class="bg-white shadow-md p-3 mb-4 bg-light border rounded-3 card">
            <h4 class="fw-bold mb-3 text-primary">Evaluasi Hasil</h4>
          
            <p><strong>Skor didapat:</strong> {{ $hasil->total_skor }}</p>
            <p><strong>Interpretasi:</strong> {{ $hasil->evaluasi->interpretasi }}</p>
            <p><strong>Intervensi:</p>
            @if($hasil->evaluasi->intervensiRows->isNotEmpty())
                <ol class="list-group">
                    @foreach($hasil->evaluasi->intervensiRows as $intervensi)
                        <li class="list-group-item">{{ $intervensi->intervensi }}</li>
                    @endforeach
                </ol>
            @else
                <p class="text-secondary">Tidak ada intervensi.</p>
            @endif
        </div>

        <!-- Buttons -->
        <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
            <a href="{{ route('skrinning.siswa.print', $hasil->id) }}" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                <i class="ri-download-2-line text-white fw-medium"></i> Download
            </a>
        </div>
    </div>
</div>

@endsection
