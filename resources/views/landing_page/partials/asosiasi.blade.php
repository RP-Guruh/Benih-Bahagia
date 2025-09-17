<div class="partner-area pt-120 pb-120" id="partner" style="margin-top: 80px;">
    <div class="container">
     
    <div class="section-title text-center mb-5">
        <span class="top-title">
            <span class="editable-partner-title">
                {{ $contents['partners']['title'] ?? 'Asosiasi & Kolaborasi' }}
            </span>
        </span>
        <h2 class="editable-partner-subtitle">
            {{ $contents['partners']['subtitle'] ?? 'Didukung oleh Perguruan Tinggi & Lembaga Akademik' }}
        </h2>
        <p class="fs-16 text-muted editable-partner-description">
            {{ $contents['partners']['description'] ?? 'Kolaborasi ini memastikan aplikasi memiliki dasar ilmiah yang kuat dan relevan untuk mendukung pemantauan tumbuh kembang anak secara efektif.' }}
        </p>
    </div>

        <div class="row justify-content-center align-items-center g-4">
            @foreach($contents['partners']['logos']['logos'] ?? [] as $logo)
                <div class="col-6 col-md-3 text-center partner-logo">
                    <img src="{{ asset($logo) }}" alt="Partner Logo" class="img-fluid partner-img">
                </div>
            @endforeach
        </div>


        @auth
            @if(in_array(auth()->user()->level_id, [1,3]))
                <div class="text-center mt-4">
                    <button id="edit-partners-section" class="btn btn-primary">Edit Asosiasi</button>
                </div>
            @endif
        @endauth
    </div>
</div>

<div class="modal fade" id="partnerSectionModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <form id="partnerSectionForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Asosiasi & Kolaborasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <!-- Judul -->
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="section_title" id="partnerTitle" class="form-control">
                </div>

                <!-- Sub Judul -->
                <div class="mb-3">
                    <label class="form-label">Sub Judul</label>
                    <input type="text" name="section_subtitle" id="partnerSubtitle" class="form-control">
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="section_description" id="partnerDescription" class="form-control" rows="3"></textarea>
                </div>

                <!-- Logo Lama + Input Baru -->
                <div class="mb-3">
                    <label class="form-label">Logo Partner</label>
                    <div id="partnerLogosForm" class="row g-3"></div>
                </div>

                <!-- Tombol Reset -->
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-danger btn-sm" id="resetPartnerLogos">
                        Reset ke Default
                    </button>
                    <input type="hidden" name="reset" id="resetFlag" value="0">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>
