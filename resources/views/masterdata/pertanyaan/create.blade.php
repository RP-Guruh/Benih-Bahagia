@extends('app')

@section('content')
<div class="main-content-container overflow-hidden">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Create Pertanyaan</h3>

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
                    <span class="fw-medium">Create Pertanyaan</span>
                </li>
            </ol>
        </nav>
    </div>

    @include('partials.alert')

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <h4 class="mb-3">Tambah Pertanyaan</h4>

            <form action="{{ route('masterdata.pertanyaan.store') }}" method="POST" class="form_save"
                enctype="multipart/form-data">
                @csrf

                {{-- Pilih Formulir --}}
                <div class="form-group mb-4">
                    <label class="form-label">Formulir *</label>
                    <select name="formulir_id" class="form-select" required id="formulirSelect">
                        <option value="">-- Pilih Formulir --</option>
                        @foreach ($formulirs as $formulir)
                            <option value="{{ $formulir->id }}" data-max="{{ $formulir->jumlah_pertanyaan }}"
                                {{ old('formulir_id') == $formulir->id ? 'selected' : '' }}>
                                {{ $formulir->judul }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Accordion Container --}}
                <div class="accordion accordion-flush faq-wrapper" id="questionsAccordion">
                    @if (old('teks'))
                        @foreach (old('teks') as $i => $oldTeks)
                            <div class="accordion-item" data-index="{{ $i }}">
                                <h2 class="accordion-header" id="heading{{ $i }}">
                                    <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $i }}"
                                        aria-expanded="{{ $i == 0 ? 'true' : 'false' }}"
                                        aria-controls="flush-collapse{{ $i }}">
                                        Pertanyaan {{ $i + 1 }}
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $i }}"
                                    class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}"
                                    data-bs-parent="#questionsAccordion">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label>Nomor</label>
                                            <input type="number" name="nomor[]" class="form-control"
                                                value="{{ old('nomor')[$i] ?? '' }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Teks Pertanyaan</label>
                                            <textarea name="teks[]" class="form-control" rows="2" required>{{ $oldTeks }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <select name="kategori[]" class="form-select" required>
                                                @foreach (['Gerak halus', 'Gerak kasar', 'Bicara dan bahasa', 'Sosialisasi dan kemandirian'] as $kategori)
                                                    <option value="{{ $kategori }}"
                                                        {{ (old('kategori')[$i] ?? '') == $kategori ? 'selected' : '' }}>
                                                        {{ $kategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tipe Jawaban</label>
                                            <select name="tipe_jawaban[]" class="form-select" required>
                                                <option value="Ya/Tidak"
                                                    {{ (old('tipe_jawaban')[$i] ?? '') == 'Ya/Tidak' ? 'selected' : '' }}>
                                                    Ya/Tidak</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Bobot Nilai</label>
                                            <input type="number" name="bobot_nilai[]" class="form-control"
                                                value="{{ old('bobot_nilai')[$i] ?? 1 }}" min="1" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Petunjuk Gambar</label>
                                            <input type="file" name="petunjuk_gambar[]" class="form-control"
                                                accept="image/*">
                                            @if (isset(old('petunjuk_gambar')[$i]))
                                                <img src="{{ old('petunjuk_gambar')[$i] }}" class="img-preview mt-1"
                                                    style="max-height:50px;">
                                            @else
                                                <img class="img-preview mt-1" style="max-height:50px;">
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-question">Hapus
                                            Pertanyaan</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <button type="button" id="add_question" class="btn btn-primary mt-3">
                    <i class="ri-add-line"></i> Tambah Pertanyaan
                </button>

                <div class="d-flex gap-3 mt-3 flex-wrap">
                     <a href="{{ route('masterdata.pertanyaan.index') }}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button type="submit" class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Pertanyaan
                                </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let questionIndex = document.querySelectorAll('#questionsAccordion .accordion-item').length;

    function getMaxQuestions() {
        const selected = document.getElementById('formulirSelect').selectedOptions[0];
        return selected ? parseInt(selected.dataset.max) : 10;
    }

    function createAccordionItem(index) {
        return `
        <div class="accordion-item" data-index="${index}">
            <h2 class="accordion-header" id="heading${index}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapse${index}" aria-expanded="false" aria-controls="flush-collapse${index}">
                    Pertanyaan ${index + 1}
                </button>
            </h2>
            <div id="flush-collapse${index}" class="accordion-collapse collapse" data-bs-parent="#questionsAccordion">
                <div class="accordion-body">
                    <div class="mb-3">
                        <label>Nomor</label>
                        <input type="number" name="nomor[]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Teks Pertanyaan</label>
                        <textarea name="teks[]" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label>
                        <select name="kategori[]" class="form-select" required>
                            <option value="Gerak halus">Gerak halus</option>
                            <option value="Gerak kasar">Gerak kasar</option>
                            <option value="Bicara dan bahasa">Bicara dan bahasa</option>
                            <option value="Sosialisasi dan kemandirian">Sosialisasi dan kemandirian</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Tipe Jawaban</label>
                        <select name="tipe_jawaban[]" class="form-select" required>
                            <option value="Ya/Tidak">Ya/Tidak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Bobot Nilai</label>
                        <input type="number" name="bobot_nilai[]" class="form-control" value="1" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label>Petunjuk Gambar</label>
                        <input type="file" name="petunjuk_gambar[]" class="form-control" accept="image/*">
                        <img class="img-preview mt-1" style="max-height:50px;">
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-question">Hapus Pertanyaan</button>
                </div>
            </div>
        </div>`;
    }

    document.getElementById('add_question').addEventListener('click', function() {
        const max = getMaxQuestions();
        if(questionIndex >= max){
            alert(`Formulir ini hanya boleh memiliki maksimal ${max} pertanyaan.`);
            return;
        }
        const accordion = document.getElementById('questionsAccordion');
        accordion.insertAdjacentHTML('beforeend', createAccordionItem(questionIndex));
        questionIndex++;
    });

    document.getElementById('questionsAccordion').addEventListener('click', function(e) {
        if(e.target.classList.contains('remove-question')){
            const item = e.target.closest('.accordion-item');
            item.remove();
            document.querySelectorAll('#questionsAccordion .accordion-item').forEach((item,index)=>{
                item.querySelector('.accordion-button').innerText = `Pertanyaan ${index+1}`;
                item.querySelector('.accordion-collapse').id = `flush-collapse${index}`;
                item.querySelector('.accordion-button').setAttribute('data-bs-target', `#flush-collapse${index}`);
                item.querySelector('.accordion-button').setAttribute('aria-controls', `flush-collapse${index}`);
            });
            questionIndex = document.querySelectorAll('#questionsAccordion .accordion-item').length;
        }
    });

    // Preview gambar
    document.getElementById('questionsAccordion').addEventListener('change', function(e) {
        if (e.target.type === 'file' && e.target.accept.includes('image')) {
            const fileInput = e.target;
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = fileInput.parentElement.querySelector('.img-preview');
                img.src = e.target.result;
            };
            if(fileInput.files[0]) reader.readAsDataURL(fileInput.files[0]);
        }
    });
});
</script>
@endpush

@push('styles')
<style>
/* Dark mode */
body[data-theme="dark"] .card,
body[data-theme="dark"] .accordion-button {
    background-color: #1e1e2f;
    color: #f1f1f1;
}
body[data-theme="dark"] .accordion-button:not(.collapsed) {
    background-color: #2a2a3b;
    color: #f1f1f1;
}
body[data-theme="dark"] .form-control,
body[data-theme="dark"] .form-select,
body[data-theme="dark"] textarea {
    background-color: #2a2a3b;
    color: #f1f1f1;
    border: 1px solid #444 !important;
}
body[data-theme="dark"] .btn-primary { background-color: #4e73df; border-color: #4e73df; }
body[data-theme="dark"] .btn-danger { background-color: #e74a3b; border-color: #e74a3b; }
body[data-theme="dark"] .btn-success { background-color: #1cc88a; border-color: #1cc88a; }
body[data-theme="dark"] .img-preview { border: 1px solid #555; }

.accordion-item {
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    margin-bottom: 0.5rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.accordion-button {
    background-color: #f8f9fa;
    color: #333;
    font-weight: 500;
    transition: background-color 0.2s, color 0.2s;
}
.accordion-button:not(.collapsed) { background-color: #e9ecef; }
.accordion-button:hover { background-color: #e2e6ea; }
.accordion-body { border-top:1px solid #ccc; padding-top:1rem; }
</style>
@endpush
@endsection
