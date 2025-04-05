import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

// import monacoEditorPlugin from 'vite-plugin-monaco-editor' //amo ini an kann monaco-editor para han codes

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            ssr: 'resources/js/ssr.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        // monacoEditorPlugin({
        //     languageWorkers: ['editorWorkerService', 'javascript'],
        // }),
    ],
});
