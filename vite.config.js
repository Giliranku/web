import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', // ← ganti ke scss
                'resources/js/app.js','resources/css/main.css','resources/css/queue-detail.css'],
            refresh: true,
        }),

    ],
});
