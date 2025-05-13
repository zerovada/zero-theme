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
      //  main: 'assets/js/frontend.js',
      //  customizer: 'assets/js/customizer.js',
        style: 'assets/scss/style.scss',
        editorStyle: 'assets/scss/editor-style.scss',
      //  'customizer-controls': 'assets/scss/customizer/_customizer-controls.scss',
        main:          path.resolve(__dirname, 'assets/js/frontend.js'),
        customizer:    path.resolve(__dirname, 'assets/js/customizer.js'),
        'customizer-preview':  path.resolve(__dirname, 'assets/js/customizer-preview.js'),
        'customizer-controls-js': path.resolve(__dirname, 'assets/js/customizer-controls-js.js'),
       // 'colors-controls': path.resolve(__dirname, 'assets/scss/customizer/customizer-colors.scss'),
       'customizer-colors-css': path.resolve(__dirname, 'assets/scss/customizer/customizer-colors.scss'),
       'customizer-controls-css': path.resolve(__dirname, 'assets/scss/customizer/customizer-controls.scss'),
       'customizer-typography': path.resolve(__dirname, 'assets/scss/customizer/typography-controls.scss'),
       'customizer-layout': path.resolve(__dirname, 'assets/scss/customizer/layout-controls.scss'),
       'customizer-buttons': path.resolve(__dirname, 'assets/scss/customizer/buttons-controls.scss'),
       'customizer-header': path.resolve(__dirname, 'assets/scss/customizer/header-controls.scss'),
       'customizer-footer': path.resolve(__dirname, 'assets/scss/customizer/footer-controls.scss'),
       'customizer-breadcrumbs': path.resolve(__dirname, 'assets/scss/customizer/breadcrumbs-controls.scss'),
       'customizer-performance': path.resolve(__dirname, 'assets/scss/customizer/performance-controls.scss'),
       'customizer-woocommerce': path.resolve(__dirname, 'assets/scss/customizer/woocommerce-controls.scss'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          const name = assetInfo.name || assetInfo.fileName;
          const ext  = path.extname(name);

          // Customizer CSS
          if ( ext === '.css' && name.includes('customizer-controls') ) {
            return 'css/customizer-controls.css';
          }

          if ( ext === '.css' && name.includes('customizer-colors') ) {
            return 'css/customizer-colors.css';
          }

          if ( name.includes('typography') ) {
            return 'css/customizer-typography.css';
          }

          if ( name.endsWith('.css') && name.includes('layout-controls') ) {
            return 'css/customizer-layout.css';
          }

          if ( name.endsWith('.css') && name.includes('buttons-controls') ) {
            return 'css/customizer-buttons.css';
          }

          if ( name.endsWith('.css') && name.includes('header-controls') ) {
            return 'css/customizer-header.css';
          }

          if ( name.endsWith('.css') && name.includes('footer-controls') ) {
            return 'css/customizer-footer.css';
          }

          if ( name.endsWith('.css') && name.includes('breadcrumbs-controls') ) {
            return 'css/customizer-breadcrumbs.css';
          }

          if ( name.endsWith('.css') && name.includes('performance-controls') ) {
            return 'css/customizer-performance.css';
          }

          if ( name.endsWith('.css') && name.includes('woocommerce-controls') ) {
            return 'css/customizer-woocommerce.css';
          }

          // 3) All other CSS files
          if ( ext === '.css' ) {
            return `css/${path.basename(name)}`;
          }

          // 4) All other asset types (images, fonts, etc.)
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
       // additionalData: `
       // @use "settings/variables" as *;
       // @use "settings/mixins" as *;
       // @use "settings/fonts" as *;
       //  `,
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
