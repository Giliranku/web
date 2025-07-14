import './bootstrap';

import 'trix';

import { Calendar } from 'vanilla-calendar-pro';
import 'vanilla-calendar-pro/styles/index.css';
import 'vanilla-calendar-pro/styles/layout.css';
import 'vanilla-calendar-pro/styles/themes/light.css';
import 'vanilla-calendar-pro/styles/themes/dark.css';

document.addEventListener('livewire:navigated', () => {
    document.addEventListener("trix-before-initialize", () => {
        // Change Trix.config if you need
      })

    // 3. Find the calendar element on the page
    const calendarElement = document.querySelector('#calendar');

    // 4. IMPORTANT: Only run the code if the calendar element actually exists on the current page.
    // This prevents errors on pages that don't have a calendar.
    if (calendarElement) {
        const options = {
            // Your options here
            selectedTheme: 'light',
            settings: {
                lang: 'en',
            },
            // Let's set the date using the current date
            // As of now, it is Thursday, June 12, 2025
            date: {
                today: new Date('2025-06-12'),
            }
        };

        // 5. Use the 'VanillaCalendar' variable you imported directly. The linter sees it's being "read" here.
        const calendar = new Calendar(calendarElement, options);
        calendar.init();

        console.log('Vanilla Calendar initialized successfully!');
    }
});