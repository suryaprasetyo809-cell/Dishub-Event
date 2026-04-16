import { defineConfig } from 'vite';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';
import path from 'path';

export default defineConfig({
  root: '.',
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: 'src/main.js',
    },
  },
  server: {
    port: 5173,
    strictPort: true,
    // Required for CORS when Vite serves assets to PHP pages
    cors: true,
    origin: 'http://localhost:5173',
  },
  css: {
    postcss: {
      plugins: [
        tailwindcss('./tailwind.config.cjs'),
        autoprefixer(),
      ],
    },
  },
});
