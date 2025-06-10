<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data
      :data-bs-theme="$store.themeSwitcher.theme">
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
</head>

<body>
    <div>
        @persist('navbar')
            <livewire:partial.navbar />
        @endpersist

        {{ $slot }}

        @persist('accessibility-widget')
            <livewire:partial.accessibility-widget />
        @endpersist

        @persist('footer')
            <livewire:partial.footer />
        @endpersist
    </div>
</body>
</html>