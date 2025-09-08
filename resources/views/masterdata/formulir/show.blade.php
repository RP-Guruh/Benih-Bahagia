@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Show Formulir</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('masterdata.formulir.index') }}" class="fw-medium">Formulir List</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Formulir Info --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Formulir Information</h4>

            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Judul Formulir</label>
                            <input type="text" class="form-control" value="{{ $formulir->judul }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Jumlah Pertanyaan</label>
                            <input type="text" class="form-control" value="{{ $formulir->jumlah_pertanyaan }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Usia Minimum</label>
                            <input type="text" class="form-control" value="{{ $formulir->usia_min ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Usia Maksimum</label>
                            <input type="text" class="form-control" value="{{ $formulir->usia_max ?? '-' }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Deskripsi</label>
                            <textarea class="form-control" rows="3" readonly>{{ $formulir->deskripsi ?? '-' }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Status</label>
                            <input type="text" class="form-control" value="{{ ucfirst($formulir->status) }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Created At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($formulir->created_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Updated At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($formulir->updated_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('masterdata.formulir.edit', $formulir->id) }}" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-edit-2-line"></i> Edit
                            </a>
                            <a href="{{ route('masterdata.formulir.index') }}" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
                                <i class="ri-arrow-go-back-line"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- List Pertanyaan --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Daftar Pertanyaan</h4>
            <div class="mb-3">
                <a href="{{ route('masterdata.pertanyaan.create', ['formulir_id' => $formulir->id]) }}" class="btn btn-success">
                    <i class="ri-add-line"></i> Tambah Pertanyaan Baru
                </a>
            </div>
            @if($formulir->pertanyaan->count() > 0)
              <div class="default-table-area style-two default-table-width">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nomor</th>
                                <th>Teks Pertanyaan</th>
                                <th>Kategori</th>
                                <th>Tipe Jawaban</th>
                                <th>Petunjuk Gambar</th>
                                <th>Action</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formulir->pertanyaan as $index => $p)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $p->nomor }}</td>
                                    <td>{{ $p->teks }}</td>
                                    <td>{{ $p->kategori }}</td>
                                    <td>{{ $p->tipe_jawaban }}</td>
                                    <td>
                                        <?php if($p->petunjuk_gambar): ?>
                                            <img src="{{ asset($p->petunjuk_gambar) }}" alt="Petunjuk Gambar" style="max-height:50px;">
                                        <?php else: ?>
                                            <span>-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Aksi Pertanyaan">
                                            <a href="{{ route('masterdata.pertanyaan.show', $p->id) }}" class="btn btn-outline-info btn-sm" title="Lihat Detail">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="{{ route('masterdata.pertanyaan.edit', $p->id) }}" class="btn btn-outline-primary btn-sm" title="Edit Pertanyaan">
                                                <i class="ri-edit-2-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('j F Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            @else
                <p class="text-muted">Belum ada pertanyaan untuk formulir ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection
