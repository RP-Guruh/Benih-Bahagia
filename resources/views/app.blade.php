<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Benih Bahagia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/iconBenih.ico') }}?v=2">

    <!-- Styles -->
    @include('partials.styles')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    @stack('styles')
    <style>

        #search-results .search-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            color: #0d6efd; /* link biru khas Bootstrap */
            text-decoration: none;
            transition: background 0.2s, text-decoration 0.2s;
        }

        #search-results .search-link:hover {
            background: #f8f9fa;
            text-decoration: underline;
            cursor: pointer;
        }

        body[data-theme="dark"] {
            background-color: #0c1427;
            color: #e0e6f0;
        }

        body[data-theme="dark"] .form-control {
            background-color: #1a2238;
            border-color: #2d3a5c;
            color: #e0e6f0;
        }
        body[data-theme="dark"] .form-control::placeholder {
            color: #9ca3af;
        }

        body[data-theme="dark"] #search-results {
            background-color: #1a2238;
            border: 1px solid #2d3a5c;
        }

        body[data-theme="dark"] #search-results .search-link {
            color: #66b2ff;
        }
        body[data-theme="dark"] #search-results .search-link:hover {
            background: #2d3a5c;
        }

        body[data-theme="dark"] .src-btn span {
            color: #9ca3af;
        }
        body[data-theme="dark"] .src-btn:hover span {
            color: #66b2ff;
        }

        
    </style>


</head>

<body class="boxed-size">
    @include('partials.sidebar')
    <div class="container-fluid">
        <div class="main-content d-flex flex-column">
            @if(auth()->check())
                @include('partials.header')
            @endif
            <div class="main-content-container overflow-hidden">
                <div class="row">
                    @yield('content')
                </div>
            </div>
            <div class="flex-grow-1"></div>
            @include('partials.footer')
        </div>
    </div>

    @include('partials.theme_settings')

    @include('partials.scripts')


    <script src="{{ asset('assets/js/form_save.js') }}"></script>
    <script src="{{ asset('assets/js/form_edit.js') }}"></script>
    <script src="{{ asset('assets/js/global_search.js') }}"></script>

    @stack('scripts')
</body>

</html>