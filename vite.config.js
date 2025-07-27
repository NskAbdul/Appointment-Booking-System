import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [laravel({
        input: ['resources/css/app.css', 'resources/js/app.js'],
        refresh: true,
    })],
    build: {
        manifest: true,
        outDir: 'public/build', // required for production
        rollupOptions: {
            input: 'resources/js/app.js', // or your entry file
        }
    }
});
