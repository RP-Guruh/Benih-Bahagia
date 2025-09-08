@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Pertanyaan</h3>

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
                    <span class="fw-medium">Edit Pertanyaan</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form action="{{ route('masterdata.pertanyaan.update', $pertanyaan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Formulir *</label>
                    <select name="formulir_id" class="form-select" required>
                        @foreach ($formulirs as $formulir)
                            <option value="{{ $formulir->id }}" {{ $pertanyaan->formulir_id == $formulir->id ? 'selected' : '' }}>
                                {{ $formulir->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nomor</label>
                    <input type="number" name="nomor" class="form-control" value="{{ old('nomor', $pertanyaan->nomor) }}" required>
                </div>

                <div class="mb-3">
                    <label>Teks Pertanyaan</label>
                    <textarea name="teks" class="form-control" rows="3" required>{{ old('teks', $pertanyaan->teks) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori" class="form-select" required>
                        @foreach (['Gerak halus','Gerak kasar','Bicara dan bahasa','Sosialisasi dan kemandirian'] as $kategori)
                            <option value="{{ $kategori }}" {{ old('kategori', $pertanyaan->kategori) == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tipe Jawaban</label>
                    <select name="tipe_jawaban" class="form-select" required>
                        <option value="Ya/Tidak" {{ old('tipe_jawaban', $pertanyaan->tipe_jawaban) == 'Ya/Tidak' ? 'selected' : '' }}>Ya/Tidak</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Bobot Nilai</label>
                    <input type="number" name="bobot_nilai" class="form-control" value="{{ old('bobot_nilai', $pertanyaan->bobot_nilai) }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label>Petunjuk Gambar</label>
                    <input type="file" name="petunjuk_gambar" class="form-control" accept="image/*">
                    @if($pertanyaan->petunjuk_gambar)
                        <img src="{{ asset($pertanyaan->petunjuk_gambar) }}" class="img-preview mt-1" style="max-height:50px;">
                    @endif
                </div>

       <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('masterdata.pertanyaan.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-save-line text-white fw-medium"></i> Update Pertanyaan
                                </button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
</div>
@endsection
