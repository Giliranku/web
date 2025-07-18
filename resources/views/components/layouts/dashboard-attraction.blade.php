<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Page Title' }}</title>

    @assets
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @endassets

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/css/main.css'
    ])
    @stack('styles')
    <!-- Alpine store for theme state -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('themeSwitcher', {
                theme: localStorage.getItem('theme') || 'light',
                setTheme(val) {
                    this.theme = val;
                    localStorage.setItem('theme', val);
                    document.documentElement.setAttribute('data-bs-theme', val);
                },
                initTheme() {
                    document.documentElement.setAttribute('data-bs-theme', this.theme);
                }
            });
            Alpine.store('themeSwitcher').initTheme();
        });
    </script>
    <!-- Alpine store for sidebar state & responsive listener -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                collapsed: window.matchMedia('(max-width: 992px)').matches
            });

            window.matchMedia('(max-width: 992px)').addEventListener('change', e => {
                Alpine.store('sidebar').collapsed = e.matches;
            });
        });
    </script>
<script src="https://cdn.tiny.cloud/1/havl6thb50958e9icgg288e5y2f7ve1lsmu8gf6sffkj292y/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        body .main-content {
            margin-left: 250px;
            width: calc(100vw - 250px);
            transition: margin-left 0.3s, width 0.3s;
            overflow-x: hidden;
            padding: 0;
        }
        body.sidebar-collapsed .main-content {
            margin-left: 80px;
            width: calc(100vw - 80px);
        }
        @media (max-width: 992px) {
            body .main-content,
            body.sidebar-collapsed .main-content {
                margin-left: 80px !important;
                width: calc(100vw - 80px) !important;
            }
        }
    </style>

    @stack('scripts')
</head>
<body x-data x-bind:class="{ 'sidebar-collapsed': $store.sidebar.collapsed }" class="overflow-x-hidden">
    @persist('admin-sidebar')
        <livewire:partial.attraction-sidebar/>
    @endpersist
    <div id="mainContent" class="main-content" x-cloak>
        {{ $slot }}
    </div>
</body>
</html>