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
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/open-dyslexic@1.0.3/open-dyslexic-regular.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.4/trix.min.css">
    @endassets

    @vite([
        'resources/sass/app.scss',
        'resources/js/app.js',
        'resources/css/main.css',
        'resources/css/accessibility.css',
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

            Alpine.store('accessibility', {
                fontSize: parseInt(localStorage.getItem('fontSize')) || 100,
                dyslexicFont: localStorage.getItem('dyslexicFont') === 'true',
                highContrast: localStorage.getItem('highContrast') === 'true',
                
                setFontSize(size) {
                    this.fontSize = Math.max(75, Math.min(150, size));
                    localStorage.setItem('fontSize', this.fontSize);
                    document.documentElement.style.fontSize = this.fontSize + '%';
                },
                
                toggleDyslexicFont() {
                    this.dyslexicFont = !this.dyslexicFont;
                    localStorage.setItem('dyslexicFont', this.dyslexicFont);
                    if (this.dyslexicFont) {
                        document.body.style.fontFamily = '"OpenDyslexic", "Open Sans", sans-serif';
                    } else {
                        document.body.style.fontFamily = '"Inclusive Sans", sans-serif';
                    }
                },
                
                toggleHighContrast() {
                    this.highContrast = !this.highContrast;
                    localStorage.setItem('highContrast', this.highContrast);
                    if (this.highContrast) {
                        document.body.classList.add('high-contrast');
                    } else {
                        document.body.classList.remove('high-contrast');
                    }
                },
                
                init() {
                    document.documentElement.style.fontSize = this.fontSize + '%';
                    if (this.dyslexicFont) {
                        document.body.style.fontFamily = '"OpenDyslexic", "Open Sans", sans-serif';
                    }
                    if (this.highContrast) {
                        document.body.classList.add('high-contrast');
                    }
                }
            });
            Alpine.store('accessibility').init();
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('accessibilityMenu', function() {
                return {
                    open: false,
                    speechActive: false,
                    utterance: null,
                    
                    increaseFontSize() {
                        this.$store.accessibility.setFontSize(this.$store.accessibility.fontSize + 10);
                    },
                    
                    decreaseFontSize() {
                        this.$store.accessibility.setFontSize(this.$store.accessibility.fontSize - 10);
                    },
                    
                    toggleDyslexicFont() {
                        this.$store.accessibility.toggleDyslexicFont();
                    },
                    
                    toggleHighContrast() {
                        this.$store.accessibility.toggleHighContrast();
                    },
                    
                    toggleDarkMode() {
                        this.$store.themeSwitcher.setTheme(this.$store.themeSwitcher.theme === 'light' ? 'dark' : 'light');
                    },
                    
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
        <livewire:partial.navbar />

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
