<div class="banner-area bg-img pb-0 position-relative" id="hero">
    <div class="container position-relative z-1">
        <div class="banner-content text-center pb-75">

            <!-- Tombol edit hanya untuk admin, di-center atas h1 -->
            @auth
                @if(in_array(Auth::user()->level_id, [1,3]))
                    <div class="d-flex justify-content-center mb-3">
                        <button id="edit-hero" class="btn btn-sm btn-primary">
                            <i class="ri-edit-2-line"></i> Edit Hero
                        </button>
                    </div>
                @endif
            @endauth

            <!-- Judul -->
            <h1 class="fs-60 mb-3 pb-md-3 baloo-2 editable-hero-title" 
                style="font-weight: 800; line-height:1.2; color:#333; font-size:48px;"
                data-key="hero_title">
                {{ $contents['hero_title'] ?? 'Pantau Tumbuh Kembang Anak dengan Mudah' }}
            </h1>

            <!-- Subjudul -->
            <p class="fs-18 m-auto mb-3 pb-md-3 mw-740 baloo-2 editable-hero-subtitle" 
               style="line-height:1.6; color:#555; font-size:22px;"
               data-key="hero_subtitle">
                {{ $contents['hero_subtitle'] ?? 'Aplikasi Benih Bahagia membantu guru memantau perkembangan murid secara digital, menyajikan data perkembangan anak dengan cara yang jelas, terstruktur, dan mudah dipahami.' }}
            </p>

            <!-- Tombol CTA -->
            <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 fs-16 fw-medium rounded-3 editable-hero-button">
                <i class="ri-user-line fs-18"></i>
                <span class="ms-1 editable-hero-button-text" data-key="hero_button_text">
                    {{ $contents['hero_button_text'] ?? 'Mulai Sekarang - Gratis' }}
                </span>
            </a>

        </div>

        <!-- Gambar Hero -->
        <div class="banner-img-wrap text-center mt-4">
            <img src="{{ $contents['hero_image'] ?? asset('assets/landing_page/images/3.png') }}" 
                 alt="banner-img" 
                 class="img-fluid editable-hero-image"
                 data-key="hero_image"
                 style="width: 100%; max-width: 600px; height: auto;">
        </div>

        <!-- Shapes (statis) -->
        <img src="{{ asset('assets/images/landing/shape-3.png') }}" class="shape shape-7" alt="shape">
        <img src="{{ asset('assets/images/landing/shape-4.png') }}" class="shape shape-8" alt="shape">
        <img src="{{ asset('assets/images/landing/shape-5.png') }}" class="shape shape-9" alt="shape">
        <img src="{{ asset('assets/images/landing/shape-6.png') }}" class="shape shape-10" alt="shape">

    </div>
</div>




<div class="modal fade" id="heroEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <form id="heroEditForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hero Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Judul -->
                <div class="mb-3">
                    <label for="heroTitle" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="heroTitle" name="hero_title" value="{{ old('hero_title', trim($contents['hero_title'] ?? '')) }}">
                </div>

                <!-- Subjudul -->
                <div class="mb-3">
                    <label for="heroSubtitle" class="form-label">Subjudul</label>
                    <textarea class="form-control" id="heroSubtitle" name="hero_subtitle" rows="4">{{ old('hero_subtitle', trim($contents['hero_subtitle'] ?? '')) }}</textarea>
                </div>

                <!-- Teks Tombol -->
                <div class="mb-3">
                    <label for="heroButtonText" class="form-label">Teks Tombol</label>
                    <input type="text" class="form-control" id="heroButtonText" name="hero_button_text" value="{{ old('hero_button_text', trim($contents['hero_button_text'] ?? '')) }}">
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="heroImage" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="heroImage" name="hero_image">
                    <img id="heroImagePreview"
                        src="{{ $contents['hero_image'] ?? asset('assets/landing_page/images/3.png') }}"
                        class="img-fluid mt-2" style="max-height:150px;">
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