<div 
    x-data="accessibilityMenu"
    class="position-fixed accessibility-widget"
    style="bottom: 20px; right: 16px; z-index: 1050;"
>
    <!-- Floating Action Button -->
    <template x-if="!open">
        <button 
            class="btn btn-primary rounded-circle shadow-lg pulse-animation"
            style="width: 60px; height: 60px; border: none; background: var(--bs-primary);"
            @click="open = true"
            aria-label="Menu Aksesibilitas"
        >
            <i class="bi bi-universal-access text-white" style="font-size: 1.6rem;"></i>
        </button>
    </template>

    <!-- Enhanced Accessibility Panel -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        @click.outside="open = false"
        class="position-fixed bg-body rounded-4 shadow-lg border border-opacity-25"
        style="bottom: 100px; left: 16px; right: 16px; width: auto; max-width: 380px; margin-left: auto; z-index: 1060; backdrop-filter: blur(10px);"
    >
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-opacity-25 bg-body-secondary rounded-top-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-universal-access me-3 text-primary" style="font-size: 1.5rem;"></i>
                <h5 class="mb-0 fw-bold text-body-emphasis accessibility-widget-text">Aksesibilitas</h5>
            </div>
            <button class="btn-close" @click="open = false" aria-label="Tutup menu"></button>
        </div>

        <!-- Content -->
        <div class="p-4 bg-body">
            <!-- Font Size Controls -->
            <div class="mb-4">
                <h6 class="fw-semibold text-body-emphasis mb-3 accessibility-widget-text">
                    <i class="bi bi-type me-2 text-primary"></i>Ukuran Teks
                </h6>
                <div class="d-flex align-items-center gap-3">
                    <button 
                        class="btn btn-outline-secondary btn-sm accessibility-widget-text"
                        @click="decreaseFontSize()"
                        aria-label="Perkecil teks"
                    >
                        <i class="bi bi-dash-lg"></i>
                    </button>
                    <span class="flex-grow-1 text-center fw-medium text-body-emphasis accessibility-widget-text" x-text="$store.accessibility.fontSize + '%'"></span>
                    <button 
                        class="btn btn-outline-secondary btn-sm accessibility-widget-text"
                        @click="increaseFontSize()"
                        aria-label="Perbesar teks"
                    >
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>
            </div>

            <!-- Accessibility Features Grid -->
            <div class="row g-3">
                <div class="col-6">
                    <button 
                        class="btn w-100 h-100 p-3 border-2 rounded-3 accessibility-btn accessibility-widget-text"
                        :class="$store.accessibility.highContrast ? 'btn-dark text-white' : 'btn-outline-dark'"
                        @click="toggleHighContrast()"
                        style="min-height: 100px; transition: all 0.3s ease;"
                        aria-pressed="false"
                        :aria-pressed="$store.accessibility.highContrast.toString()"
                    >
                        <i class="bi bi-eye-fill d-block mb-2" style="font-size: 1.5rem;"></i>
                        <small class="fw-medium">Kontras Tinggi</small>
                    </button>
                </div>
                
                <div class="col-6">
                    <button 
                        class="btn w-100 h-100 p-3 border-2 rounded-3 accessibility-btn accessibility-widget-text"
                        :class="$store.accessibility.dyslexicFont ? 'btn-success text-white' : 'btn-outline-success'"
                        @click="toggleDyslexicFont()"
                        style="min-height: 100px; transition: all 0.3s ease;"
                        aria-pressed="false"
                        :aria-pressed="$store.accessibility.dyslexicFont.toString()"
                    >
                        <i class="bi bi-fonts d-block mb-2" style="font-size: 1.5rem;"></i>
                        <small class="fw-medium">Font Disleksia</small>
                    </button>
                </div>
                
                <div class="col-6">
                    <button 
                        class="btn w-100 h-100 p-3 border-2 rounded-3 accessibility-btn accessibility-widget-text"
                        :class="speechActive ? 'btn-warning text-white' : 'btn-outline-warning'"
                        @click="toggleSpeech()"
                        style="min-height: 100px; transition: all 0.3s ease;"
                        aria-pressed="false"
                        :aria-pressed="speechActive.toString()"
                    >
                        <i class="d-block mb-2" style="font-size: 1.5rem;" :class="speechActive ? 'bi bi-pause-fill' : 'bi bi-volume-up-fill'"></i>
                        <small class="fw-medium" x-text="speechActive ? 'Hentikan Suara' : 'Bantuan Suara'"></small>
                    </button>
                </div>
                
                <div class="col-6">
                    <button 
                        class="btn w-100 h-100 p-3 border-2 rounded-3 accessibility-btn accessibility-widget-text"
                        :class="$store.themeSwitcher.theme === 'dark' ? 'btn-secondary text-white' : 'btn-outline-secondary'"
                        @click="toggleDarkMode()"
                        style="min-height: 100px; transition: all 0.3s ease;"
                        aria-pressed="false"
                        :aria-pressed="($store.themeSwitcher.theme === 'dark').toString()"
                    >
                        <i class="d-block mb-2" style="font-size: 1.5rem;" :class="$store.themeSwitcher.theme === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-stars-fill'"></i>
                        <small class="fw-medium" x-text="$store.themeSwitcher.theme === 'dark' ? 'Mode Terang' : 'Mode Gelap'"></small>
                    </button>
                </div>
            </div>

            <!-- Reset Button -->
            <div class="mt-4 pt-3 border-top border-opacity-25">
                <button 
                    class="btn btn-outline-danger btn-sm w-100 accessibility-widget-text"
                    @click="
                        $store.accessibility.setFontSize(100);
                        $store.accessibility.dyslexicFont && $store.accessibility.toggleDyslexicFont();
                        $store.accessibility.highContrast && $store.accessibility.toggleHighContrast();
                        $store.themeSwitcher.theme === 'dark' && $store.themeSwitcher.setTheme('light');
                        speechActive && toggleSpeech();
                    "
                    aria-label="Reset semua pengaturan aksesibilitas"
                >
                    <i class="bi bi-arrow-clockwise me-2"></i>Reset Semua
                </button>
            </div>
        </div>
    </div>
</div>