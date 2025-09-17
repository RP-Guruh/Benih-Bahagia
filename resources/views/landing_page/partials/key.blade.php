<div class="key-features-area pt-150 pb-125 position-relative z-2" id="features">
    <div class="container">
        <div class="section-title">
            <span class="top-title">
                <span class="editable-feature-subtitle">{{ $contents['features']['subtitle'] ?? 'Keunggulan Kami' }}</span>
            </span>
            <h2 class="editable-feature-title">{{ $contents['features']['title'] ?? 'Membantu Guru dalam Memantau Perkembangan Anak' }}</h2>
        </div>

        <div class="row justify-content-center" id="featureItems">
            @foreach($contents['features']['features'] as $item)
                <div class="col-lg-4 col-md-6 feature-item">
                    <div class="key-features-single-item">
                        <i class="material-symbols-outlined wh-87 d-inline-block {{ $item['icon_class'] ?? 'bg-primary bg-opacity-25 text-primary' }} editable-feature-icon">
                            {!! $item['icon'] !!}
                        </i>
                        <h3 class="editable-feature-heading">{!! $item['heading'] !!}</h3>
                        <p class="editable-feature-desc" style="font-size:16px;">
                            {{ $item['desc'] }}
                        </p>
                    </div>
                </div>
            @endforeach
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


<!-- Modal Edit Features -->
<div class="modal fade" id="editFeaturesModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editFeaturesForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit Features</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Subtitle -->
          <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text" class="form-control" id="featureSubtitle" name="subtitle">
          </div>

          <!-- Title -->
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" id="featureTitle" name="title">
          </div>

          <!-- Items -->
          <div id="featureItemsForm">
            <!-- Dinamis ditambah via JS -->
          </div>

          <button type="button" id="addFeatureItem" class="btn btn-outline-primary btn-sm mt-2">
            <i class="ri-add-line me-1"></i> Tambah Feature
          </button>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
