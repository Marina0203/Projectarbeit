const path = require('path')
import {viteStaticCopy} from 'vite-plugin-static-copy'

export default {
  root: path.resolve(__dirname, 'src'),
  build: {
    // outDir: '../../../public/_assets', // for TYPO3
    outDir: '../dist',
    rollupOptions: {
      // prevents building of index.html
      input: {
        main: path.resolve(__dirname, 'src/js/main.js'),
      },
      output: {
        entryFileNames: 'js/app.js',
        assetFileNames: 'css/app.css',
      }
    }
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'src'),
      '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
      '~bootstrap-icons': path.resolve(__dirname, 'node_modules/bootstrap-icons'), // depending on project
    }
  },
  server: {
    port: 8080,
    hot: true
  },
  plugins: [
    // copy static assets to outDir
    viteStaticCopy({
      targets: [
        {
          src: path.resolve(__dirname, 'src/img') + '/[!.]*',
          dest: 'images',
        },
        {
          src: path.resolve(__dirname, 'node_modules/bootstrap-icons/font/fonts') + '/[!.]*',
          dest: 'fonts/bootstrap-icons',
        },
        {
          src: path.resolve(__dirname, 'src/fonts/open-sans-v36-latin') + '/[!.]*',
          dest: 'fonts/open-sans-v36-latin',
        },
      ],
    }),
  ]
}
