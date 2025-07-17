import './bootstrap';

import 'trix';

import { Calendar } from 'vanilla-calendar-pro';
import 'vanilla-calendar-pro/styles/index.css';
import 'vanilla-calendar-pro/styles/layout.css';
import 'vanilla-calendar-pro/styles/themes/light.css';
import 'vanilla-calendar-pro/styles/themes/dark.css';

window.Calendar = Calendar;

document.addEventListener('livewire:navigated', () => {
    document.addEventListener("trix-before-initialize", () => {
        // Change Trix.config if you need
    })

});