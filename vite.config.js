import { defineConfig } from 'vite'; // Mengimpor fungsi defineConfig dari Vite untuk mendefinisikan konfigurasi proyek.
import laravel from 'laravel-vite-plugin'; // Mengimpor plugin laravel-vite-plugin untuk integrasi dengan Laravel.
import { createHtmlPlugin } from 'vite-plugin-html'; // Mengimpor plugin untuk memanipulasi HTML.
import tailwindcss from 'tailwindcss'; // Mengimpor Tailwind CSS untuk digunakan dalam proyek.

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'], // Menentukan file input untuk Laravel.
      refresh: true, // Mengaktifkan refresh otomatis saat ada perubahan.
    }),
    createHtmlPlugin({
      minify: true, // Mengaktifkan minifikasi HTML untuk mengurangi ukuran file.
    }),
  ],
  css: {
    postcss: {
      plugins: [tailwindcss], // Menambahkan Tailwind CSS sebagai plugin PostCSS.
    },
  },
});