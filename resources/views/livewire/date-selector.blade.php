<div x-data="{
    selectedDate: @entangle('selectedDate'),
    calendarId: 'calendar-' + Math.random().toString(36).substr(2, 9),
    calendarRetries: 0,
    showFallbackInput: false,

    initCalendar() {
        // Wait for Calendar library to be available
        if (typeof Calendar === 'undefined') {
            // Retry for up to 3 seconds
            if (!this.calendarRetries) this.calendarRetries = 0;
            if (this.calendarRetries < 30) {
                this.calendarRetries++;
                setTimeout(() => this.initCalendar(), 100);
            } else {
                console.warn('Calendar library not available, using fallback date input');
                this.showFallbackInput = true;
            }
            return;
        }

        // Ensure DOM element exists
        const calendarElement = document.getElementById(this.calendarId);
        if (!calendarElement) {
            setTimeout(() => this.initCalendar(), 50);
            return;
        }

        try {
            const options = {
                type: 'default',
                onClickDate: (self) => {
                    this.selectedDate = self.context.selectedDates[0];
                },
            };

            const calendar = new Calendar('#' + this.calendarId, options);
            calendar.init();
        } catch (error) {
            console.error('Calendar initialization error:', error);
            // Fallback: show simple date input
            this.showFallbackInput = true;
        }
    },

    formattedDate() {
        if (!this.selectedDate) return 'Pilih Tanggal Kunjungan';

        try {
            return new Date(this.selectedDate).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                timeZone: 'UTC'
            });
        } catch (error) {
            console.error('Error formatting date:', error);
            return 'Pilih Tanggal Kunjungan';
        }
    },
}" x-init="$nextTick(() => initCalendar())">
    <div class="modern-date-selector dropdown">
        <div class="date-selector-button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-offset="0,2">
            <div class="date-icon">
                <i class="bi bi-calendar"></i>
            </div>
            <div class="date-content">
                <label class="date-label">Tanggal Kunjungan</label>
                <div class="selected-date" x-text="formattedDate()">
                    Pilih Tanggal Kunjungan
                </div>
            </div>
            <div class="dropdown-arrow">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>

        <div class="dropdown-menu modern-dropdown" style="min-width: 300px; padding: 0;">
            <div class="calendar-header">
                <i class="fas fa-calendar-check me-2"></i>
                <span>Pilih Tanggal Kunjungan Anda</span>
            </div>
            
            <!-- Calendar Container -->
            <div x-show="!showFallbackInput" :id="calendarId" x-ref="calendarContainer" class="calendar-container"></div>
            
            <!-- Fallback Date Input -->
            <div x-show="showFallbackInput" class="p-3">
                <label class="form-label">Pilih Tanggal:</label>
                <input type="date" 
                       class="form-control" 
                       x-model="selectedDate"
                       :min="new Date().toISOString().split('T')[0]">
            </div>
            
            <div class="calendar-footer">
                <small class="text-muted">
                    <i class="fas fa-info-circle me-1"></i>
                    Pilih tanggal untuk melanjutkan pemesanan
                </small>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.modern-date-selector {
    position: relative;
    z-index: 1050;
}

.date-selector-button {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    position: relative;
    overflow: hidden;
}

.date-selector-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(37, 99, 235, 0.1), transparent);
    transition: left 0.6s;
}

.date-selector-button:hover::before {
    left: 100%;
}

.date-selector-button:hover {
    border-color: #2563eb;
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.15);
    transform: translateY(-2px);
}

.date-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    margin-right: 16px;
    position: relative;
    z-index: 1;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
}

.date-content {
    flex: 1;
    text-align: left;
    position: relative;
    z-index: 1;
}

.date-label {
    display: block;
    font-size: 0.875rem;
    color: #64748b;
    font-weight: 500;
    margin-bottom: 2px;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}

.selected-date {
    font-size: 1.1rem;
    font-weight: 700;
    color: #334155;
    margin: 0;
    line-height: 1.2;
}

.dropdown-arrow {
    color: #64748b;
    font-size: 0.9rem;
    margin-left: 12px;
    transition: transform 0.3s ease;
    position: relative;
    z-index: 1;
}

.date-selector-button[aria-expanded="true"] .dropdown-arrow {
    transform: rotate(180deg);
}

.modern-dropdown {
    background: white;
    border: none;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    padding: 0;
    margin-top: 0px !important;
    overflow: hidden;
    animation: dropdownSlide 0.2s ease-out;
    z-index: 1060 !important;
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    transform-origin: top center;
    transform: none !important;
    inset: auto auto auto 0px !important;
    margin: 2px 0 0 0 !important;
}

/* Override Bootstrap dropdown positioning */
.dropdown-menu.modern-dropdown {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    right: 0 !important;
    transform: none !important;
    margin-top: 2px !important;
}

@keyframes dropdownSlide {
    from {
        opacity: 0;
        transform: translateY(-5px) scale(0.98);
    }
    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

.calendar-header {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: white;
    padding: 16px 20px;
    font-weight: 600;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.calendar-container {
    padding: 16px;
}

.calendar-footer {
    padding: 12px 20px;
    background: #f8fafc;
    border-top: 1px solid #e2e8f0;
    text-align: center;
}

/* Calendar styling overrides */
.calendar-container {
    font-family: 'Inclusive Sans', sans-serif;
}

.calendar-container .calendar-month-year {
    font-weight: 700;
    color: #334155;
    font-size: 1.1rem;
    margin-bottom: 12px;
}

.calendar-container .calendar-day {
    padding: 8px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
}

.calendar-container .calendar-day:hover {
    background: #eff6ff;
    color: #2563eb;
}

.calendar-container .calendar-day.selected {
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    color: white;
    font-weight: 700;
}

.calendar-container .calendar-day.today {
    background: #fef3c7;
    color: #d97706;
    font-weight: 700;
}

.calendar-container .calendar-day.disabled {
    color: #cbd5e1;
    cursor: not-allowed;
}

.calendar-container .calendar-day.disabled:hover {
    background: transparent;
    color: #cbd5e1;
}

/* Navigation buttons */
.calendar-container .calendar-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.calendar-container .calendar-nav button {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 8px 12px;
    color: #475569;
    cursor: pointer;
    transition: all 0.2s ease;
}

.calendar-container .calendar-nav button:hover {
    background: #e2e8f0;
    border-color: #cbd5e1;
}

/* Day labels */
.calendar-container .calendar-day-labels {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
    margin-bottom: 4px;
}

.calendar-container .calendar-day-label {
    padding: 8px 4px;
    text-align: center;
    font-size: 0.75rem;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Days grid */
.calendar-container .calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 4px;
}

/* Responsive */
@media (max-width: 576px) {
    .date-selector-button {
        padding: 14px 16px;
    }
    
    .date-icon {
        width: 40px;
        height: 40px;
        font-size: 1rem;
        margin-right: 12px;
    }
    
    .selected-date {
        font-size: 1rem;
    }
    
    .modern-dropdown {
        min-width: 280px !important;
        left: 0 !important;
        right: 0 !important;
        margin-top: 2px !important;
    }
    
    .calendar-container {
        padding: 12px;
    }
    
    /* Force mobile positioning */
    .dropdown-menu.modern-dropdown {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        right: 0 !important;
        transform: none !important;
        margin-top: 2px !important;
    }
}
</style>
@endpush
