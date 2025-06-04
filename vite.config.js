import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/filament/user/theme.css',  // ini boleh jika memang dipakai
        'resources/css/filament/user/tailwind.config.js',  // ini boleh jika memang dipakai
      ],
      refresh: true,
    }),
  ],
  build: {
    outDir: 'public/build',
  },
});
