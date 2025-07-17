<div x-data="{

    selectedDate: @entangle('selectedDate'),

    initCalendar() {

        const options = {
            type: 'default',
            onClickDate: (self) => {
                this.selectedDate = self.context.selectedDates[0];
            },
        };

        const calendar = new Calendar('#calendar', options)

        calendar.init();
    },

    formattedDate() {
        if (!this.selectedDate) return 'Pilih Tanggal';

        try {
            return new Date(this.selectedDate).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                timeZone: 'UTC'
            });
        } catch (error) {
            console.error('Error formatting date:', error);
            return 'Pilih Tanggal';
        }
    },
}" x-init="initCalendar()">
    <div class="dropdown border border-dark rounded-3">
        <button style="width: 100%; height: 55px;" class="btn btn-light dropdown-toggle" type="button"
            data-bs-toggle="dropdown">
            <div class="d-flex p-3">
                <img src="{{ asset('img/calendar.png') }}" alt="">
            </div>
            <div class="container">
                <p>Tanggal Kedatangan</p>
                <h5 x-text="formattedDate()">
                    {{-- This text shows before Alpine loads --}}
                </h5>
            </div>
        </button>

        <ul class="dropdown-menu">
            <div id="calendar" x-ref="calendarContainer"></div>
        </ul>
    </div>
</div>
