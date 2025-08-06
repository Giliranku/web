<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :data-bs-theme="$store.themeSwitcher.theme">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Giliranku' }}</title>
    @vite(['resources/sass/app.scss',
            'resources/js/app.js',
            'resources/css/accessibility.css',
            ])

    @assets
    {{-- External CDN assets --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans:ital,wght@0,300..700;1,300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/open-dyslexic-regular.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    @endassets

    @stack('styles')

    {{-- Declare stack of scripts --}}
    @stack('scripts')
</head>

<body>
    <div>

        {{ $slot }}
        @persist('accessibility-widget')
            <livewire:partial.accessibility-widget />
        @endpersist
    </div>
</body>
</html>