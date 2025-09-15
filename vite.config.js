import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/custom/css/style.css',
                'resources/custom/css/styles.css',
                'resources/custom/css/admin.css',
                'resources/custom/js/script.js',
                'resources/custom/js/script2.js',
                'resources/custom/js/admin.js',
            ],
            refresh: true,
        }),
    ],
});
