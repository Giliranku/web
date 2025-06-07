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
        @vite(['resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/main.css'])
        

    </head>
    <body>
        <div>
            @persist('navbar')
                <livewire:partial.navbar />
            @endpersist
            {{ $slot }}

            @persist('footer')
                <livewire:partial.footer />
            @endpersist
        </div>
    </body>
</html>
