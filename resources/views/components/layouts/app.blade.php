<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
        @vite(['resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/main.css',
                'resources/css/jesselyn.css'])

    </head>
    <body>
        <div>
            @persist('navbar')
                <livewire:partial.navbar />
            @endpersist
            {{ $slot }}
        </div>
    </body>
</html>
