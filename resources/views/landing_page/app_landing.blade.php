<!DOCTYPE html>
<html lang="zxx">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Links Of CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/prism.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/rangeslider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/google-icon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/lightpick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/landing_page/images/favicon.png') }}">

    <!-- Google fonts -->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

     <style>

        .baloo-2-logo {
            font-family: "Baloo 2", sans-serif;
            font-optical-sizing: auto;
            font-weight: 400;
            font-style: normal;
        }

        .baloo-2 {
            font-family: "Baloo 2", sans-serif;
            font-optical-sizing: auto;
        }

            .partner-img {
        max-height: 100px; /* ukuran logo */
        width: auto;
        filter: grayscale(100%);
        transition: filter 0.3s ease, transform 0.3s ease;
    }
    .partner-logo {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        padding: 30px 20px; /* tambah ruang atas-bawah */
    }
    .partner-logo:hover {
        transform: translateY(-6px) scale(1.08);
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
    }
    .partner-logo:hover .partner-img {
        filter: grayscale(0%);
        transform: scale(1.05);
    }

       .edu-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .edu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
    .edu-thumb {
        position: relative;
        overflow: hidden;
    }
    .edu-thumb img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .edu-card:hover .edu-thumb img {
        transform: scale(1.08);
    }
    .edu-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0,0,0,0.7);
        color: #fff;
        font-size: 12px;
        padding: 4px 10px;
        border-radius: 12px;
    }
    .edu-content {
        padding: 20px;
        flex: 1;
    }
    .edu-content h5 {
        font-size: 18px;
        margin-bottom: 10px;
        line-height: 1.4;
    }
    .edu-content p {
        font-size: 14px;
        color: #666;
        margin-bottom: 0;
    }
    /* spacing antar section biar lega */
    .py-120 {
        padding-top: 120px;
        padding-bottom: 120px;
    }
    .edu-video-area iframe {
        border: 0;
    }

    /* Responsif biar logo nggak kegedean di layar kecil */
    @media (max-width: 576px) {
        .partner-img {
            max-height: 70px;
        }
        .partner-logo {
            padding: 20px 15px; /* lebih kecil di HP */
        }
    }

    .footer-area {
        background: #1d1f27;
    }
    .footer-single h5 {
        font-size: 18px;
        color: #fff;
    }
    .footer-single a:hover {
        color: #fff !important;
    }
    .footer-logo img {
        max-height: 55px;
    }
    .hover:hover {
        color: #0d6efd !important;
    }
     </style>

    <!-- Title -->
    <title>Benih Bahagia</title>
</head>
<body data-bs-spy="scroll"
      data-bs-target="#navbar-example2"
      data-bs-root-margin="0px 0px -40%"
      data-bs-smooth-scroll="true"
      class="scrollspy-example"
      tabindex="0">

    <!-- Header -->
    @include('landing_page.partials.header')
    <!-- Hero Section -->
    @include('landing_page.partials.hero')
    <!-- Asosiasi Section -->
    @include('landing_page.partials.asosiasi')
    <!-- Key Features Section -->
    @include('landing_page.partials.key')
    <!-- About App Section -->
    @include('landing_page.partials.about_app')
    <!-- Edukasi section -->
    @include('landing_page.partials.article')
    <!-- footer -->
    @include('landing_page.partials.footer')

    @yield('content')

    <!-- JS Files -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('assets/js/dragdrop.js') }}"></script>
    <script src="{{ asset('assets/js/rangeslider.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/prism.js') }}"></script>
    <script src="{{ asset('assets/js/clipboard.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/js/echarts.js') }}"></script>
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/fullcalendar.main.js') }}"></script>
    <script src="{{ asset('assets/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/world-merc.js') }}"></script>
    <script src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/lightpick.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/echarts.js') }}"></script>
    <script src="{{ asset('assets/js/custom/custom.js') }}"></script>

    @stack('scripts')
</body>
</html>
