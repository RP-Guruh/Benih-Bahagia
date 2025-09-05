<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trezo - Laravel Admin Dashboard Template</title>
    <!-- Styles -->
    @include('partials.styles')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>

<body class="boxed-size bg-white">
   
                @yield('content')
            

    @include('partials.theme_settings')

    @include('partials.scripts')
    @stack('scripts')
</body>

</html>