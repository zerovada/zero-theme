import { defineConfig } from 'vite';
import path from 'path';
import autoprefixer from 'autoprefixer';
import cssnano from 'cssnano';

export default defineConfig({
  root: process.cwd(),
  base: './',
  build: {
    outDir: 'assets/dist',
    assetsDir: '',
    manifest: true,
    rollupOptions: {
      input: {
        main: 'assets/js/frontend.js',
        customizer: 'assets/js/customizer.js',
        style: 'assets/scss/style.scss',
        editorStyle: 'assets/scss/editor-style.scss',
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: ({ name }) => {
          if (name && name.endsWith('.css')) return 'css/[name]';
          return 'assets/[name].[ext]';
        },
      },
    },
    cssCodeSplit: true,
    sourcemap: process.env.NODE_ENV !== 'production',
    minify: 'esbuild',
  },
  css: {
    preprocessorOptions: {
      scss: {
        includePaths: [ path.resolve(__dirname, 'assets/scss/settings') ],
        additionalData: `
        @use "settings/variables" as *;
        @use "settings/mixins" as *;
        @use "settings/fonts" as *;
         `,
       // includePaths: [
        //  path.resolve(__dirname, 'assets/scss'),
        //  path.resolve(__dirname, 'assets/scss/settings')
       // ]
      },
    },
    postcss: {
      plugins: [autoprefixer(), cssnano({ preset: 'default' })],
    },
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'assets/js')
    },
  },
});
