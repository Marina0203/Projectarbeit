import {resolve} from 'path'
import {defineConfig} from 'vite'

export default defineConfig({
  root: resolve(__dirname, 'src'),
  build: {
    // outDir: '../dist',
    outDir: '../../public/',
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/js/main.js'),
      },
      output: {
        entryFileNames: `assets/[name].js`,
        chunkFileNames: `assets/[name].js`,
        assetFileNames: `assets/[name].[ext]`
      }
    },
    minify: {
      compress: {
        drop_console: true,
        drop_debugger: true,
        keep_fnames: true,
      },
      mangle: {
        keep_fnames: true,
      },
    },
  },
  resolve: {
    alias: {
      '@': resolve(__dirname, 'src'),
      '~bootstrap': resolve(__dirname, 'node_modules/bootstrap'),
      '~bootstrap-icons': resolve(__dirname, 'node_modules/bootstrap-icons'),
    }
  },
  server: {
    port: 8080,
    hot: true
  },
  plugins: []
})
