<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') &mdash; DigiQrify</title>

    {{-- <link rel="shortcut icon" href="{{ asset('svg/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon"
        href='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyBpZD0iTGF5ZXJfMiIgZGF0YS1uYW1lPSJMYXllciAyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2aWV3Qm94PSIwIDAgMTUuODcgMTUuODciPgogIDxkZWZzPgogICAgPHN0eWxlPgogICAgICAuY2xzLTEgewogICAgICAgIGZpbGw6ICMwZDUzN2Q7CiAgICAgIH0KCiAgICAgIC5jbHMtMSwgLmNscy0yLCAuY2xzLTMsIC5jbHMtNCwgLmNscy01LCAuY2xzLTYsIC5jbHMtNywgLmNscy04LCAuY2xzLTkgewogICAgICAgIHN0cm9rZS13aWR0aDogMHB4OwogICAgICB9CgogICAgICAuY2xzLTIgewogICAgICAgIGZpbGw6IHVybCgjbGluZWFyLWdyYWRpZW50KTsKICAgICAgfQoKICAgICAgLmNscy0zIHsKICAgICAgICBmaWxsOiAjZmZmOwogICAgICB9CgogICAgICAuY2xzLTQgewogICAgICAgIGZpbGw6IHVybCgjbGluZWFyLWdyYWRpZW50LTIpOwogICAgICB9CgogICAgICAuY2xzLTUgewogICAgICAgIGZpbGw6IHVybCgjbGluZWFyLWdyYWRpZW50LTMpOwogICAgICB9CgogICAgICAuY2xzLTYgewogICAgICAgIGZpbGw6ICMwMzlkZDE7CiAgICAgIH0KCiAgICAgIC5jbHMtNyB7CiAgICAgICAgZmlsbDogIzEyNzRiYTsKICAgICAgfQoKICAgICAgLmNscy04IHsKICAgICAgICBmaWxsOiB1cmwoI2xpbmVhci1ncmFkaWVudC00KTsKICAgICAgfQoKICAgICAgLmNscy05IHsKICAgICAgICBmaWxsOiAjMjViMTZmOwogICAgICB9CiAgICA8L3N0eWxlPgogICAgPGxpbmVhckdyYWRpZW50IGlkPSJsaW5lYXItZ3JhZGllbnQiIHgxPSI0LjI3IiB5MT0iMTMuNjkiIHgyPSI2LjgxIiB5Mj0iMTAuMiIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiMwYTZkMzgiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMmY4MmMxIiBzdG9wLW9wYWNpdHk9Ii4wMyIvPgogICAgPC9saW5lYXJHcmFkaWVudD4KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0ibGluZWFyLWdyYWRpZW50LTIiIHgxPSIzLjg1IiB5MT0iOS4yMSIgeDI9IjcuNjEiIHkyPSIxNC44NyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPgogICAgICA8c3RvcCBvZmZzZXQ9IjAiIHN0b3AtY29sb3I9IiMyNTNkOGIiLz4KICAgICAgPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjMmY4MmMxIiBzdG9wLW9wYWNpdHk9Ii4wMyIvPgogICAgPC9saW5lYXJHcmFkaWVudD4KICAgIDxsaW5lYXJHcmFkaWVudCBpZD0ibGluZWFyLWdyYWRpZW50LTMiIHgxPSI3LjE4IiB5MT0iLS44IiB4Mj0iNy4xOCIgeTI9Ii0uODciIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KICAgICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjODVjNTRhIi8+CiAgICAgIDxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzI0ODRjNiIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8L2xpbmVhckdyYWRpZW50PgogICAgPGxpbmVhckdyYWRpZW50IGlkPSJsaW5lYXItZ3JhZGllbnQtNCIgeDE9IjEwLjQxIiB5MT0iOS4xIiB4Mj0iNi4wMSIgeTI9IjcuNTkiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KICAgICAgPHN0b3Agb2Zmc2V0PSIwIiBzdG9wLWNvbG9yPSIjNjliYzQ1Ii8+CiAgICAgIDxzdG9wIG9mZnNldD0iLjUiIHN0b3AtY29sb3I9IiM0NjlmODYiIHN0b3Atb3BhY2l0eT0iLjQ5Ii8+CiAgICAgIDxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzI0ODRjNiIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8L2xpbmVhckdyYWRpZW50PgogIDwvZGVmcz4KICA8ZyBpZD0iTGF5ZXJfMS0yIiBkYXRhLW5hbWU9IkxheWVyIDEiPgogICAgPGNpcmNsZSBjbGFzcz0iY2xzLTMiIGN4PSI3LjkzIiBjeT0iNy45MyIgcj0iNy45MyIvPgogICAgPGc+CiAgICAgIDxnPgogICAgICAgIDxwYXRoIGNsYXNzPSJjbHMtOSIgZD0ibTcuMTgsNS4yOWMtMi4yLDAtMy45OCwxLjk3LTMuOTgsNC40czEuNzgsNC40LDMuOTgsNC40LDMuOTgtMS45NywzLjk4LTQuNC0xLjc4LTQuNC0zLjk4LTQuNFptMCw3LjAxYy0xLjMsMC0yLjM1LTEuMTctMi4zNS0yLjZzMS4wNS0yLjYsMi4zNS0yLjYsMi4zNSwxLjE3LDIuMzUsMi42LTEuMDUsMi42LTIuMzUsMi42WiIvPgogICAgICAgIDxwYXRoIGNsYXNzPSJjbHMtMiIgZD0ibTcuMTgsNS4yOWMtMi4yLDAtMy45OCwxLjk3LTMuOTgsNC40czEuNzgsNC40LDMuOTgsNC40LDMuOTgtMS45NywzLjk4LTQuNC0xLjc4LTQuNC0zLjk4LTQuNFptMCw3LjAxYy0xLjMsMC0yLjM1LTEuMTctMi4zNS0yLjZzMS4wNS0yLjYsMi4zNS0yLjYsMi4zNSwxLjE3LDIuMzUsMi42LTEuMDUsMi42LTIuMzUsMi42WiIvPgogICAgICAgIDxwYXRoIGNsYXNzPSJjbHMtNiIgZD0ibTQuODMsOS42OWMwLS41LjEzLS45Ny4zNS0xLjM2bC0xLjk3LDEuMTZjMCwuMDcsMCwuMTMsMCwuMiwwLDIuNDMsMS43OCw0LjQsMy45OCw0LjQuMTIsMCwuMjQsMCwuMzYtLjAybC0xLjE5LTEuOTVjLS44OS0uMzctMS41MS0xLjMyLTEuNTEtMi40M1oiLz4KICAgICAgICA8cGF0aCBjbGFzcz0iY2xzLTQiIGQ9Im00LjgzLDkuNjljMC0uNS4xMy0uOTcuMzUtMS4zNmwtMS45NywxLjE2YzAsLjA3LDAsLjEzLDAsLjIsMCwyLjQzLDEuNzgsNC40LDMuOTgsNC40LjEyLDAsLjI0LDAsLjM2LS4wMmwtMS4xOS0xLjk1Yy0uODktLjM3LTEuNTEtMS4zMi0xLjUxLTIuNDNaIi8+CiAgICAgICAgPHBhdGggY2xhc3M9ImNscy01IiBkPSJtNy4xOCw1LjI5Yy0yLjA0LDAtMy43MSwxLjY5LTMuOTUsMy44OGgwczAsMCwwLDBjMCwwLDAsMCwwLDBoMHMtLjAxLjEtLjAxLjE1YzAsLjA1LS4wMS4yMi0uMDEuMjJsMS45OC0xLjIzaDBzMCwwLDAsMGMuNDItLjczLDEuMTUtMS4yMiwxLjk5LTEuMjIsMS4yOCwwLDIuMzIsMS4xMywyLjM1LDIuNTNoMS42MmMtLjAzLTIuNC0xLjgtNC4zMy0zLjk4LTQuMzNaIi8+CiAgICAgICAgPHBhdGggY2xhc3M9ImNscy04IiBkPSJtNy4xOCw1LjI5Yy0yLjA0LDAtMy43MSwxLjY5LTMuOTUsMy44OGgwczAsMCwwLDBjMCwwLDAsMCwwLDBoMHMtLjAxLjEtLjAxLjE1YzAsLjA1LS4wMS4yMi0uMDEuMjJsMS45OC0xLjIzaDBzMCwwLDAsMGMuNDItLjczLDEuMTUtMS4yMiwxLjk5LTEuMjIsMS4yOCwwLDIuMzIsMS4xMywyLjM1LDIuNTNoMS42MmMtLjAzLTIuNC0xLjgtNC4zMy0zLjk4LTQuMzNaIi8+CiAgICAgICAgPHBhdGggY2xhc3M9ImNscy05IiBkPSJtMTAuNzgsMS4wN2gtLjAyYy0uMjUtLjE1LS41Ny0uMTUtLjgyLDBoMGMtLjI1LjE0LS40LjM4LS40LjYzdjcuOTRoMS42MlYxLjY3YzAtLjI0LS4xNC0uNDctLjM4LS42WiIvPgogICAgICA8L2c+CiAgICAgIDxwYXRoIGNsYXNzPSJjbHMtNyIgZD0ibTcuNzQsOS42NXYxLjE3YzAsLjM0LS4zLjYtLjY1LjU0LS4yNy0uMDUtLjQ1LS4zLS40NS0uNTd2LS41NGgtLjUzYy0uMjMsMC0uNDYtLjEzLS41NC0uMzUtLjA5LS4yMi0uMDItLjQ1LjEyLS41OS4xLS4xLjI0LS4xNi4zOS0uMTZoMS4xMmMuMjgsMCwuNTIuMjIuNTQuNVoiLz4KICAgICAgPHBhdGggY2xhc3M9ImNscy05IiBkPSJtNi42Myw5Ljc2di0xLjE3YzAtLjM0LjMtLjYuNjUtLjU0LjI3LjA1LjQ1LjMuNDUuNTd2LjU0aC41M2MuMjMsMCwuNDYuMTMuNTQuMzUuMDkuMjIuMDIuNDUtLjEyLjU5LS4xLjEtLjI0LjE2LS4zOS4xNmgtMS4xMmMtLjI4LDAtLjUyLS4yMi0uNTQtLjVaIi8+CiAgICAgIDxwYXRoIGNsYXNzPSJjbHMtMSIgZD0ibTcuNzQsOS42NnYuNjFoLS41NmMtLjI4LDAtLjUyLS4yMi0uNTQtLjV2LS42MWguNTZjLjI4LDAsLjUyLjIyLjU0LjVaIi8+CiAgICA8L2c+CiAgPC9nPgo8L3N2Zz4='
        type="image/svg"> --}}

    <link rel="stylesheet" href="{{ asset('extensions/@fortawesome/fontawesome-free/css/all.min.css') }}">

    @stack('style')

    {{-- Template CSS --}}
    <link rel="stylesheet" href="{{ asset('compiled/css/table-datatable-jquery.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('compiled/css/iconly.css') }}">
</head>

<body>
    <script src="{{ asset('static/js/initTheme.js') }}"></script>
    <div id="app">
        @include('components.sidebar')
        <div id="main">
            @include('components.navbar')

            @yield('main')

            @include('components.footer')
        </div>
    </div>
    <script src="{{ asset('static/js/components/dark.js') }}"></script>
    <script src="{{ asset('extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>


    <script src="{{ asset('compiled/js/app.js') }}"></script>

    @stack('script')
    <script>
        // If you want to use tooltips in your project, we suggest initializing them globally
        // instead of a "per-page" level.
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }, false);
    </script>
</body>

</html>
