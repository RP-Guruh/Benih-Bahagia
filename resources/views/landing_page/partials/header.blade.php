<nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top" id="navbar">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ $contents['navbar_logo'] ?? asset('assets/landing_page/images/logo-cropeed.png') }}"
            alt="Logo Benih"
            class="img-fluid editable-logo"
            style="max-height: 65px; width:auto;">

        <span class="fw-bold ms-2 baloo-2-logo editable-title"
            style="color:#524FD9; font-size:28px;">
            {{ $contents['navbar_title'] ?? 'Benih Bahagia' }}
        </span>

        </a>

        @auth
            @if(in_array(Auth::user()->level_id, [1,3]))
                <button id="edit-header" class="btn btn-sm btn-outline-primary ms-2">
                    <i class="ri-edit-2-line"></i> Edit
                </button>
            @endif
        @endauth


        <!-- Toggle Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 baloo-2-logo" style="font-size:20px;">
                <li class="nav-item">
                    <a class="nav-link active fw-medium" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#articles">Edukasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-medium" href="#about-app">Tentang Kami</a>
                </li>
            </ul>

            <!-- Tombol Login -->
            <a href="{{ route('login') }}" 
               class="btn btn-primary fw-bold rounded-pill px-4 ms-lg-3 baloo-2-logo" style="font-size:18px;">
              
                <i class="ri-login-box-line me-1"></i> Login Guru
            </a>
        </div>
    </div>
</nav>

<div class="modal fade" id="headerEditModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="headerEditForm" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Header Bar</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="siteTitle" class="form-label">Judul</label>
            <input type="text" class="form-control" id="siteTitle" name="title" 
                   value="{{ $contents['navbar_title'] ?? 'Benih Bahagia' }}">
          </div>
          <div class="mb-3">
            <label for="siteLogo" class="form-label">Logo</label>
            <input type="file" class="form-control" id="siteLogo" name="logo">
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
