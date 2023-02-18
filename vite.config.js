import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({command, mode}) => {
    const env = loadEnv(mode, process.cwd(), '')
    return {
        server: {
            https: {
                cert: "./.docker/nginx/cert/" + env.APP_HOST + ".crt",
                key: "./.docker/nginx/cert//" + env.APP_HOST + ".key",
            },
            host: env.APP_HOST,
            hmr: {
                host: env.APP_HOST,
            },
        },
        plugins: [
            laravel({
                input: 'resources/js/app.js',
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
        ],
    }
});
