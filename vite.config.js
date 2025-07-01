import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/main.css',
                'resources/css/sorting.css',
                'resources/css/jesselyn.css',
                'resources/css/queue-detail.css',
                'resources/css/login-page.css',
                'resources/css/register-page.css',
                'resources/css/invoice-page.css',
                'resources/css/user-profile-page.css'
                // 'public/js/userprofile.js'
            ],
            refresh: true,
        }),

    ],
});
