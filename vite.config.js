import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss',
                'resources/js/app.js',
                'resources/css/main.css',
                'resources/css/accessibility.css',
                'resources/css/sorting.css',
                'resources/css/jesselyn.css',
                'resources/css/queue-detail.css',
                'resources/css/login-page.css',
                'resources/css/register-page.css',
                'resources/css/invoice-page.css',
                'resources/css/user-profile-page.css',
                'resources/css/staff-profile-page.css',
                'resources/css/trix-custom.css',
                'resources/css/yoga.css',
                'resources/css/tiket-ecommerce.css',
                'resources/css/product-card.css',
                'resources/css/cart-modern.css',
                'resources/css/wahana-detail.css',

                // 'public/js/userprofile.js'
            ],
            refresh: true,
        }),

    ],
});
