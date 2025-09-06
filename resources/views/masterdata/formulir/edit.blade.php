@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Formulir</h3>

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
                    <span class="fw-medium">Edit</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h3 class="mb-0">Edit Formulir</h3>
                </div>

                <form action="{{ route('masterdata.formulir.update', $formulir->id) }}" method="POST" class="form_save">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Judul Formulir *</label>
                                <input required type="text" class="form-control" name="judul"
                                       placeholder="Type formulir title" 
                                       value="{{ old('judul', $formulir->judul) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Jumlah Pertanyaan *</label>
                                <input required type="number" class="form-control" name="jumlah_pertanyaan"
                                       placeholder="Jumlah pertanyaan" 
                                       value="{{ old('jumlah_pertanyaan', $formulir->jumlah_pertanyaan) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Usia Minimum</label>
                                <input type="number" class="form-control" name="usia_min"
                                       placeholder="Usia minimal" 
                                       value="{{ old('usia_min', $formulir->usia_min) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Usia Maksimum</label>
                                <input type="number" class="form-control" name="usia_max"
                                       placeholder="Usia maksimal" 
                                       value="{{ old('usia_max', $formulir->usia_max) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label">Deskripsi</label>
                                <textarea class="form-control text-dark" name="deskripsi" cols="30" rows="3"
                                          placeholder="Deskripsi formulir">{{ old('deskripsi', $formulir->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label">Status *</label>
                                <select name="status" class="form-select" required>
                                    <option value="aktif" {{ old('status', $formulir->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $formulir->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('masterdata.formulir.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-save-line text-white fw-medium"></i> Update Formulir
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
