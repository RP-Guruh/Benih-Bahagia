@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Detail Pertanyaan</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('masterdata.pertanyaan.index') }}" class="fw-medium">Pertanyaan List</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Detail Pertanyaan</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Informasi Pertanyaan</h4>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Formulir</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->formulir->judul }}" readonly>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Nomor</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->nomor }}" readonly>
                </div>

                <div class="col-lg-12 mb-3">
                    <label class="form-label fw-bold">Teks Pertanyaan</label>
                    <textarea class="form-control" rows="3" readonly>{{ $pertanyaan->teks }}</textarea>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->kategori }}" readonly>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Tipe Jawaban</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->tipe_jawaban }}" readonly>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Bobot Nilai</label>
                    <input type="text" class="form-control" value="{{ $pertanyaan->bobot_nilai }}" readonly>
                </div>

                <div class="col-lg-6 mb-3">
                    <label class="form-label fw-bold">Petunjuk Gambar</label><br>
                    @if($pertanyaan->petunjuk_gambar)
                        <img src="{{ asset($pertanyaan->petunjuk_gambar) }}" alt="Petunjuk Gambar" style="max-height:100px;">
                    @else
                        <span>-</span>
                    @endif
                </div>

                <div class="col-lg-12 d-flex gap-3 mt-3">
                    <a href="{{ route('masterdata.pertanyaan.edit', $pertanyaan->id) }}" class="btn btn-primary">
                        <i class="ri-edit-2-line"></i> Edit
                    </a>
                    <a href="{{ route('masterdata.pertanyaan.index') }}" class="btn btn-secondary">
                        <i class="ri-arrow-go-back-line"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
