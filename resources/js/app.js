import './bootstrap';

import { Calendar } from 'vanilla-calendar-pro';
import 'vanilla-calendar-pro/styles/index.css';
import 'vanilla-calendar-pro/styles/layout.css';
import 'vanilla-calendar-pro/styles/themes/light.css';
import 'vanilla-calendar-pro/styles/themes/dark.css';

document.addEventListener('DOMContentLoaded', () => {
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

let tambahButton = document.getElementById('tambah')


tambahButton.addEventListener('click', function (e) {
    // Find the closest parent widget, if the clicked element is inside one
    const widget = e.target.closest('.quantity-widget');

    if (!widget) {
        return; // Exit if the click was not inside a widget
    }

    // Find the elements within this specific widget
    const stepper = widget.querySelector('.quantity-stepper');


    stepper.classList.remove('d-none');
    tambahButton.classList.remove('d-flex');
    tambahButton.classList.add('d-none');

});

let add = document.getElementById("add");
let minus = document.getElementById("minus");

add.addEventListener('click', function (e) {
    const widget = e.target.closest('.quantity-widget');
    const input = widget.querySelector('.quantity-input');

    let value = parseInt(input.value)

    value++

    input.value = value
})

minus.addEventListener('click', function (e) {
    const widget = e.target.closest('.quantity-widget');
    const input = widget.querySelector('.quantity-input');

    let value = parseInt(input.value)

    value--

    if (value < 1) {
        console.log("dibawah 1")
        const stepper = widget.querySelector('.quantity-stepper');
        stepper.classList.add('d-none');
        tambahButton.classList.remove('d-none');
        return
    }

    input.value = value

})