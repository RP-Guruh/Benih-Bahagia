<div class="key-features-area pt-150 pb-125 position-relative z-2" id="features">
    <div class="container">
        <div class="section-title">
            <span class="top-title">
                <span class="editable-feature-subtitle">Keunggulan Kami</span>
            </span>
            <h2 class="editable-feature-title">Membantu Guru dalam Memantau Perkembangan Anak</h2>
        </div>

        <div class="row justify-content-center" id="featureItems">
            <!-- Skrinning -->
            <div class="col-lg-4 col-md-6 feature-item">
                <div class="key-features-single-item">
                    <i class="material-symbols-outlined wh-87 bg-primary bg-opacity-25 d-inline-block text-primary editable-feature-icon">
                        fact_check
                    </i>
                    <h3 class="editable-feature-heading">Skrinning</h3>
                    <p class="editable-feature-desc" style="font-size:16px;">
                        Guru dapat melakukan skrining perkembangan anak dengan mudah
                        menggunakan instrumen digital yang terstruktur dan praktis.
                    </p>
                </div>
            </div>

            <!-- Edukasi -->
            <div class="col-lg-4 col-md-6 feature-item">
                <div class="key-features-single-item">
                    <i class="material-symbols-outlined wh-87 bg-success bg-opacity-25 d-inline-block text-success editable-feature-icon">
                        school
                    </i>
                    <h3 class="editable-feature-heading">Edukasi</h3>
                    <p class="editable-feature-desc" style="font-size:16px;">
                        Menyediakan materi edukatif bagi guru dan orang tua untuk
                        mendukung proses tumbuh kembang anak secara optimal.
                    </p>
                </div>
            </div>

            <!-- Konsultasi -->
            <div class="col-lg-4 col-md-6 feature-item">
                <div class="key-features-single-item position-relative">
                    <i class="material-symbols-outlined wh-87 bg-warning bg-opacity-25 d-inline-block text-warning editable-feature-icon">
                        support_agent
                    </i>
                    <h3 class="editable-feature-heading">
                        Konsultasi
                    </h3>
                    <p class="editable-feature-desc" style="font-size:16px;">
                        Fitur konsultasi akan memudahkan guru berkomunikasi dengan ahli atau orang tua,
                        sehingga intervensi dapat dilakukan lebih cepat dan tepat.
                    </p>
                </div>
            </div>
        </div>

        <!-- Tombol Edit -->
        @if(auth()->check() && in_array(auth()->user()->level_id, [1,3]))
        <div class="text-center mt-3">
            <button id="edit-features-section" 
                    class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="ri-edit-2-fill me-1"></i>
                Edit Features
            </button>
        </div>
        @endif
    </div>
</div>


<div class="modal fade" id="editFeaturesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="featureSectionForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit Features Section</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label>Section Subtitle</label>
            <input type="text" name="subtitle" id="featureSubtitle" class="form-control">
          </div>

          <div class="mb-3">
            <label>Section Title</label>
            <input type="text" name="title" id="featureTitle" class="form-control">
          </div>

          <div id="featureItemsForm"></div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
