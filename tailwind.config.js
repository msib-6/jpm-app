import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import flowbitePlugin from 'flowbite/plugin';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js', // Tambahkan ini
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                custom1: '#82947A',
                custom2: '#A9A4C9',
                custom3: '#2C3B64',
                custom4: '#F2C36B',
                custom5: '#D08F68',
                custom6: '#D9B2A9',
            },
        },
    },
    plugins: [forms, flowbitePlugin], // Tambahkan flowbitePlugin di sini
};
