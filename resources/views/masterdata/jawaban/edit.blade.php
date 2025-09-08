@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Edit Jawaban</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('masterdata.jawaban.index') }}" class="fw-medium">Jawaban List</a>
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
                    <h3 class="mb-0">Edit data jawaban</h3>
                </div>

                <form action="{{ route('masterdata.jawaban.update', $jawaban->id) }}" method="POST" class="form_save">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Nilai Minimum *</label>
                                <input required type="number" class="form-control" name="nilai_min"
                                       placeholder="Nilai Minimum" value="{{ old('nilai_min', $jawaban->nilai_min) }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Nilai Maksimum *</label>
                                <input required type="number" class="form-control" name="nilai_max"
                                       placeholder="Nilai Maksimum" value="{{ old('nilai_max', $jawaban->nilai_max) }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label">Interpretasi*</label>
                                <textarea required class="form-control text-dark" name="interpretasi" cols="30" rows="3"
                                          placeholder="Interpretasi jawaban">{{ old('interpretasi', $jawaban->interpretasi) }}</textarea>
                            </div>
                        </div>

                        {{-- Jawaban Intervensi Rows --}}
                        <div class="col-lg-12">
                            <label class="label mb-2">Jawaban Intervensi</label>
                            <div id="intervensi-wrapper">
                                @forelse(old('intervensi', $jawaban->intervensiRows->pluck('intervensi')) as $row)
                                    <div class="card mb-3 intervensi-card">
                                        <div class="card-body d-flex align-items-center gap-2">
                                            <input type="text" name="intervensi[]" class="form-control" value="{{ $row }}" placeholder="Isi jawaban intervensi">
                                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="card mb-3 intervensi-card">
                                        <div class="card-body d-flex align-items-center gap-2">
                                            <input type="text" name="intervensi[]" class="form-control" placeholder="Isi jawaban intervensi">
                                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" class="btn btn-success btn-sm" id="add-row">
                                <i class="ri-add-line"></i> Tambah Row
                            </button>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('masterdata.jawaban.index') }}" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-save-line text-white fw-medium"></i> Update Jawaban
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script dynamic add/remove row --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('intervensi-wrapper');
        const addBtn = document.getElementById('add-row');

        addBtn.addEventListener('click', () => {
            const card = document.createElement('div');
            card.classList.add('card', 'mb-3', 'intervensi-card');
            card.innerHTML = `
                <div class="card-body d-flex align-items-center gap-2">
                    <input type="text" name="intervensi[]" class="form-control" placeholder="Isi jawaban intervensi">
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            `;
            wrapper.appendChild(card);
        });

        wrapper.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('.intervensi-card').remove();
            }
        });
    });
</script>
@endpush
@endsection
