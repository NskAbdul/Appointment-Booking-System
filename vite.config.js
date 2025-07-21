import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path'; // Add this line

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/scss/app.scss', // Add this line
            ],
            refresh: true,
        }),
    ],
    resolve: { // Add this whole block
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});