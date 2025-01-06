import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
      build: {
    // Arahkan output build ke public_html
    outDir: '../public_html/build',
    // Pastikan assets dalam folder build
    assetsDir: 'assets'
  },
  base: '/build/'
});
