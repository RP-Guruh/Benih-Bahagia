@extends('app')
@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Form tambah data jawaban</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('masterdata.jawaban.index') }}" class="d-flex align-items-center text-decoration-none">
                        <span class="text-secondary fw-medium hover">Jawaban</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Create</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
                    <h3 class="mb-0">Tambah data jawaban</h3>
                </div>

                <form action="{{ route('masterdata.jawaban.store') }}" method="POST" class="form_save">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Nilai Minimum *</label>
                                <input required type="number" class="form-control" name="nilai_min"
                                       placeholder="Nilai Minimum" value="{{ old('nilai_min') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label class="label">Nilai Maksimum *</label>
                                <input required type="number" class="form-control" name="nilai_max"
                                       placeholder="Nilai Maksimum" value="{{ old('nilai_max') }}">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-4">
                                <label class="label">Interpretasi*</label>
                                <textarea required class="form-control text-dark" name="interpretasi" cols="30" rows="3"
                                          placeholder="Interpretasi jawaban">{{ old('interpretasi') }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <label class="label d-block mb-2">Jawaban Intervensi</label>

                            <div id="intervensiContainer">
                                <!-- Row default -->
                                <div class="card mb-2 intervensi-card">
                                    <div class="card-body d-flex align-items-center gap-2">
                                        <input type="text" name="intervensi[0][jawaban]" class="form-control" placeholder="Isi jawaban intervensi">
                                        <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="addRow" class="btn btn-sm btn-success mt-2">
                                <i class="ri-add-line"></i> Tambah Baris
                            </button>
                        </div>

                        <div class="col-lg-12 mt-4">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('masterdata.jawaban.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Jawaban
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let rowIdx = 1;
    document.getElementById('addRow').addEventListener('click', function() {
        let container = document.getElementById('intervensiContainer');
        let card = document.createElement('div');
        card.classList.add('card', 'mb-2', 'intervensi-card');
        card.innerHTML = `
            <div class="card-body d-flex align-items-center gap-2">
                <input type="text" name="intervensi[${rowIdx}][jawaban]" class="form-control" placeholder="Isi jawaban intervensi">
                <button type="button" class="btn btn-outline-danger btn-sm removeRow">
                    <i class="ri-delete-bin-line"></i>
                </button>
            </div>
        `;
        container.appendChild(card);
        rowIdx++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.removeRow')) {
            e.target.closest('.intervensi-card').remove();
        }
    });
</script>
@endpush
@endsection
