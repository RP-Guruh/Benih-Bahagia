<div class="tailor-area position-relative z-1" style="margin-bottom: 80px;" id="about-app">
    <div class="container">
        <div class="row align-items-center">
            <!-- Gambar ilustrasi -->
            <div class="col-lg-6">
                <div class="tailor-img">
                    <img src="{{ asset($contents['about_app']['image'] ?? 'assets/landing_page/images/produk-1.png') }}" 
                         alt="Ilustrasi aplikasi">
                </div>
            </div>

            <!-- Konten penjelasan -->
            <div class="col-lg-6">
                <div class="tailor-content">
                    <h2 class="editable-about-title">{{ $contents['about_app']['title'] ?? 'Judul Aplikasi' }}</h2>
                    <p class="mb-4 editable-about-desc">
                        {!! $contents['about_app']['description'] ?? 'Deskripsi aplikasi belum tersedia.' !!}
                    </p>
                  
                    <ul class="ps-0 mb-0 list-unstyled" id="aboutItems">
                        @foreach($contents['about_app']['features'] ?? [] as $item)
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="material-symbols-outlined fs-20 text-primary">done_outline</i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="editable-about-heading">{!! $item['heading'] ?? '' !!}</h3>
                                    <p class="editable-about-item-desc">{{ $item['desc'] ?? '' }}</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- dekorasi -->
    <img src="{{ asset('assets/landing_page/images/shape-1.png') }}" class="shape shape-1" alt="shape">


    @if(auth()->check() && in_array(auth()->user()->level_id, [1,3]))
    <div class="text-center mt-3">
        <button id="edit-about-section" class="btn btn-primary d-inline-flex align-items-center gap-2">
            <i class="ri-edit-2-fill me-1"></i> Edit About App
        </button>
    </div>
    @endif
</div>

<!-- Modal Edit About App -->
<div class="modal fade" id="editAboutModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="editAboutForm">
        <div class="modal-header">
          <h5 class="modal-title">Edit About App</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Title -->
          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control" id="aboutTitle" name="title">
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea class="form-control" id="aboutDesc" name="description" rows="3"></textarea>
          </div>

          <!-- Items -->
          <div id="aboutItemsForm">
          </div>

          <button type="button" id="addAboutItem" class="btn btn-outline-primary btn-sm mt-2">
            <i class="ri-add-line me-1"></i> Tambah Item
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
