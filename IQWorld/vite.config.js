import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/css/animation.css',
                'resources/css/container.css',
                'resources/css/specific.css',
                'resources/css/style.css',
                'resources/css/color.css',
                // JS
                'resources/js/app.js',
                'resources/js/speedcalcul.js',
            ],
            refresh: true,
        }),
    ],
});
