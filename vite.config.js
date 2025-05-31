import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/user/tailwind.config.js','resources/css/filament/user/theme.css'],
            // input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/filament/user/tailwind.config.js'],
            refresh: true,
        }),
    ],
        build: {
        // The outDir should be set to your public directory
        outDir: 'public/build',
    },
});
