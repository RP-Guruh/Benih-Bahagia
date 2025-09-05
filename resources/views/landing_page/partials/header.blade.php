<nav
  class="navbar navbar-expand-lg bg-white navbar-light container-fluid py-3 position-fixed"
>
  <div class="container">
<a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
    <img src="{{ asset('assets/landing_page/images/logobenih2.png') }}" 
         alt="Logo Benih" 
         class="img-fluid" 
         style="max-height: 70px; width: auto;">
</a>


    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasNavbar"
      aria-controls="offcanvasNavbar"
    >
      <span class="navbar-toggler-icon"></span>
    </button>
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="offcanvasNavbar"
      aria-labelledby="offcanvasNavbarLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body">
        <ul
          class="navbar-nav align-items-center justify-content-end flex-grow-1 pe-3"
        >
          <li class="nav-item">
            <a
              class="nav-link active px-3"
              aria-current="page"
              href="#hero"
              >Beranda</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link px-3" href="#blog"
              >Edukasi</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link px-3" href="#about">Tentang Kami</a>
          </li>
        
        </ul>

        <div
          class="d-flex mt-5 mt-lg-0 ps-lg-3 align-items-center justify-content-center"
        >
         
        <a href="{{ route('login') }}" 
   class="btn btn-primary ms-md-3" 
   style="font-weight: bold;">
   Login Guru
</a>

        </div>
      </div>
    </div>
  </div>
</nav>
