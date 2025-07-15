<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data :data-bs-theme="$store.themeSwitcher.theme">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? "Giliranku" }}</title>

    @assets
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans:ital,wght@0,300..700;1,300..700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.4/trix.min.css">
    @endassets

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/css/main.css',
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
    document.addEventListener('alpine:init', () => {
        Alpine.data('accessibilityMenu', function() {
            return {
                open: false,
                speechActive: false,
                utterance: null,
                toggleSpeech() {
                    if (this.speechActive) {
                        window.speechSynthesis.cancel();
                        this.speechActive = false;
                    } else {
                        const slotContent = document.getElementById('main-slot-content');
                        if (slotContent) {
                            const text = slotContent.innerText.trim();
                            if (text) {
                                window.speechSynthesis.cancel();
                                this.utterance = new window.SpeechSynthesisUtterance(text);

                                const voices = window.speechSynthesis.getVoices();
                                const indonesianVoice = voices.find(v => v.lang.startsWith('id') && v.localService && !v.name.toLowerCase().includes('google'));
                                if (indonesianVoice) {
                                    this.utterance.voice = indonesianVoice;
                                } else {
                                    const localVoice = voices.find(v => v.localService);
                                    if (localVoice) this.utterance.voice = localVoice;
                                }
                                this.utterance.rate = 1;
                                this.utterance.pitch = 1;

                                this.utterance.onend = () => {
                                    this.speechActive = false;
                                };
                                this.utterance.onerror = () => {
                                    this.speechActive = false;
                                };

                                window.speechSynthesis.speak(this.utterance);
                                this.speechActive = true;
                            }
                        }
                    }
                }
            }
        });
    });
    </script>

    {{-- Declare stack of scripts --}}
    @stack('scripts')
</head>

<body>
    <div>
        @persist('navbar')
            <livewire:partial.navbar />
        @endpersist

        <main id="main-slot-content">
            {{ $slot }}
        </main>
        @persist('accessibility-widget')
            <livewire:partial.accessibility-widget />
        @endpersist

        @persist('footer')
            <livewire:partial.footer />
        @endpersist
    </div>
</body>

</html>
