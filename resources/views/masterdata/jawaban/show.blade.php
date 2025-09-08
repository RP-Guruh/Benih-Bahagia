@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Detail Jawaban</h3>

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
                    <span class="fw-medium">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    {{-- Jawaban Info --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Jawaban Information</h4>

            <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Nilai Minimum</label>
                            <input type="text" class="form-control" value="{{ $jawaban->nilai_min }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Nilai Maksimum</label>
                            <input type="text" class="form-control" value="{{ $jawaban->nilai_max }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-4">
                            <label class="label">Interpretasi</label>
                            <textarea class="form-control" rows="3" readonly>{{ $jawaban->interpretasi }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Created At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($jawaban->created_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group mb-4">
                            <label class="label">Updated At</label>
                            <input type="text" class="form-control"
                                   value="{{ \Carbon\Carbon::parse($jawaban->updated_at)->translatedFormat('j F Y H:i') }}"
                                   readonly>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ route('masterdata.jawaban.edit', $jawaban->id) }}" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                <i class="ri-edit-2-line"></i> Edit
                            </a>
                            <a href="{{ route('masterdata.jawaban.index') }}" class="btn btn-secondary py-2 px-4 fw-medium fs-16">
                                <i class="ri-arrow-go-back-line"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- List Jawaban Intervensi --}}
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Daftar Jawaban Intervensi</h4>

            @if($jawaban->intervensiRows->count() > 0)
              <div class="default-table-area style-two default-table-width">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Jawaban Intervensi</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jawaban->intervensiRows as $index => $row)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $row->intervensi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->created_at)->translatedFormat('j F Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            @else
                <p class="text-muted">Belum ada jawaban intervensi untuk jawaban ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection
