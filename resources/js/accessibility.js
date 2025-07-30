// Accessibility Alpine.js Components and Stores
document.addEventListener('alpine:init', () => {
    // Theme Switcher Store
    Alpine.store('themeSwitcher', {
        theme: localStorage.getItem('theme') || 'light',
        
        init() {
            this.applyTheme();
            // Apply theme immediately on page load
            document.addEventListener('DOMContentLoaded', () => {
                this.applyTheme();
            });
        },
        
        setTheme(theme) {
            this.theme = theme;
            localStorage.setItem('theme', theme);
            this.applyTheme();
        },
        
        applyTheme() {
            document.documentElement.setAttribute('data-bs-theme', this.theme);
            document.body.setAttribute('data-bs-theme', this.theme);
        }
    });

    // Accessibility Store
    Alpine.store('accessibility', {
        fontSize: parseInt(localStorage.getItem('fontSize')) || 100,
        dyslexicFont: localStorage.getItem('dyslexicFont') === 'true',
        highContrast: localStorage.getItem('highContrast') === 'true',
        
        init() {
            this.applyFontSize();
            this.applyDyslexicFont();
            this.applyHighContrast();
            
            // Apply settings immediately on page load
            document.addEventListener('DOMContentLoaded', () => {
                this.applyFontSize();
                this.applyDyslexicFont();
                this.applyHighContrast();
            });
        },
        
        setFontSize(size) {
            this.fontSize = Math.max(80, Math.min(150, size));
            localStorage.setItem('fontSize', this.fontSize);
            this.applyFontSize();
        },
        
        toggleDyslexicFont() {
            this.dyslexicFont = !this.dyslexicFont;
            localStorage.setItem('dyslexicFont', this.dyslexicFont);
            this.applyDyslexicFont();
        },
        
        toggleHighContrast() {
            this.highContrast = !this.highContrast;
            localStorage.setItem('highContrast', this.highContrast);
            this.applyHighContrast();
        },
        
        applyFontSize() {
            const scale = this.fontSize / 100;
            document.documentElement.style.setProperty('--accessibility-font-scale', scale);
        },
        
        applyDyslexicFont() {
            if (this.dyslexicFont) {
                document.body.classList.add('dyslexic-font');
            } else {
                document.body.classList.remove('dyslexic-font');
            }
        },
        
        applyHighContrast() {
            if (this.highContrast) {
                document.body.classList.add('high-contrast');
                document.documentElement.classList.add('high-contrast');
            } else {
                document.body.classList.remove('high-contrast');
                document.documentElement.classList.remove('high-contrast');
            }
        }
    });

    // Accessibility Menu Component (defined only once globally)
    Alpine.data('accessibilityMenu', function() {
        return {
            open: false,
            speechActive: false,
            utterance: null,
            
            init() {
                // Ensure stores are initialized and applied
                this.$nextTick(() => {
                    this.$store.themeSwitcher.init();
                    this.$store.accessibility.init();
                    
                    // Force apply states after short delay to ensure DOM is ready
                    setTimeout(() => {
                        this.$store.themeSwitcher.applyTheme();
                        this.$store.accessibility.applyFontSize();
                        this.$store.accessibility.applyDyslexicFont();
                        this.$store.accessibility.applyHighContrast();
                    }, 100);
                });
            },
            
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

// Global initialization function to ensure accessibility settings are applied
document.addEventListener('DOMContentLoaded', function() {
    // Wait for Alpine to be ready
    document.addEventListener('alpine:init', () => {
        // Initialize stores on every page load
        setTimeout(() => {
            if (window.Alpine && window.Alpine.store) {
                window.Alpine.store('themeSwitcher').init();
                window.Alpine.store('accessibility').init();
            }
        }, 50);
    });
    
    // Fallback initialization without Alpine
    setTimeout(() => {
        // Apply theme from localStorage
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', theme);
        document.body.setAttribute('data-bs-theme', theme);
        
        // Apply accessibility settings from localStorage
        const fontSize = parseInt(localStorage.getItem('fontSize')) || 100;
        const scale = fontSize / 100;
        document.documentElement.style.setProperty('--accessibility-font-scale', scale);
        
        if (localStorage.getItem('dyslexicFont') === 'true') {
            document.body.classList.add('dyslexic-font');
        }
        
        if (localStorage.getItem('highContrast') === 'true') {
            document.body.classList.add('high-contrast');
            document.documentElement.classList.add('high-contrast');
        }
    }, 10);
});
