<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data :data-bs-theme="$store.themeSwitcher.theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Restaurant Management Dashboard - Giliranku' }}</title>

    @assets
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/open-dyslexic-regular.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @endassets

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/css/main.css',
        'resources/css/accessibility.css',
    ])
    @stack('styles')

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
        
        /* Enhanced sidebar navigation styling */
        .nav-item .nav-link {
            margin: 2px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-item .nav-link:not(.active):hover {
            background-color: var(--bs-body-secondary) !important;
            transform: translateX(4px);
        }
        
        .nav-item .nav-link i {
            width: 20px;
            margin-right: 12px;
            text-align: center;
        }
        
        .nav-item .nav-link.active {
            background: linear-gradient(135deg, var(--bs-primary), var(--bs-info)) !important;
            box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
        }
    </style>

    @stack('scripts')
</head>
<body x-data x-bind:class="{ 'sidebar-collapsed': $store.sidebar.collapsed }" class="overflow-x-hidden">
    @persist('admin-sidebar')
        <livewire:partial.restaurant-sidebar/>
    @endpersist
    <div id="mainContent" class="main-content" x-cloak>
        <main id="main-slot-content">
            {{ $slot }}
        </main>
    </div>
</body>
</html>