<div 
    x-data="{ open: false }"
    class="position-fixed bottom-0 end-0 m-4"
    style="z-index: 1050;"
>
    <!-- Button -->
    <template x-if="!open">
        <button 
            class="btn btn-primary rounded-circle shadow"
            style="width: 60px; height: 60px;"
            @click="open = true"
            aria-label="Accessibility Menu"
        >
            <i class="bi bi-universal-access" style="font-size: 1.5rem;"></i>
        </button>
    </template>

    <!-- Full Popup -->
    <div 
        x-show="open"
        x-transition
        @click.outside="open = false"
        class="position-fixed bottom-0 end-0 mb-5 me-5 bg-white rounded shadow-lg p-4"
        style="width: 320px; z-index: 1060;"
    >
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Aksesibilitas</h5>
            <button class="btn-close" @click="open = false"></button>
        </div>

        <div class="row g-3">
            <div class="col-6">
                <button class="btn btn-outline-primary w-100 h-100 p-3">
                    <i class="bi bi-eye me-2"></i><br>
                    Kontras Tinggi
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-outline-primary w-100 h-100 p-3">
                    <i class="bi bi-type me-2"></i><br>
                    Perbesar Teks
                </button>
            </div>
            <div class="col-6">
                <button class="btn btn-outline-primary w-100 h-100 p-3">
                    <i class="bi bi-volume-up me-2"></i><br>
                    Bantuan Suara
                </button>
            </div>
            <div class="col-6">
                <button 
                    class="btn btn-outline-primary w-100 h-100 p-3"
                    @click="$store.themeSwitcher.setTheme($store.themeSwitcher.theme === 'light' ? 'dark' : 'light')"
                >
                    <i class="bi bi-moon-stars me-2"></i><br>
                    Mode Gelap
                </button>
            </div>
        </div>
    </div>
</div>