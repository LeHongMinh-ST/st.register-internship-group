import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.scss',
                'resources/css/auth.scss',
                'resources/js/app.js',
                'resources/js/campaign/index.js',
                'resources/js/auth/login.js',
            ],
            refresh: true,
        }),
    ],
});
