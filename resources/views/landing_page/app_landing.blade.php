<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Benih Bahagia - Pantau Tumbuh Kembang Anak')</title>

    <!-- Vendor CSS -->
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing_page/css/vendor.css') }}">
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/landing_page/css/styles.css') }}">


    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Custom Style -->
  
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Script -->
    <script src="{{ asset('assets/landing_page/js/modernizr.js') }}"></script>

    @stack('styles')
</head>

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">

    
    @include('landing_page.partials.header')
    @include('landing_page.partials.hero')
    @include('landing_page.partials.article')
    @include('landing_page.partials.video')
    @include('landing_page.partials.about')
    @include('landing_page.partials.footer')
    
    @yield('content')
    @stack('scripts')
    <script src="{{ asset('assets/landing_page/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/landing_page/js/plugins.js') }}"></script>
    <script src="{{ asset('assets/landing_page/js/script.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>
<script>
  const videoSwiper = new Swiper('.video-swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      768: { slidesPerView: 2 }, 
      992: { slidesPerView: 3 }  
    }
  });
</script>


<script>
  var scrollSpy = new bootstrap.ScrollSpy(document.body, {
    target: '#header-nav',
    offset: 100
  })
</script>


</body>



</html>
