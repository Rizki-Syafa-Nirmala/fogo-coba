import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resource/css/filament/user/tailwind.config.js', 'resource/css/filament/user/theme.css'],
            refresh: true,
        }),
    ],
});
