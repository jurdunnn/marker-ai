import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#355070',          // A rich, dark blue
                'primary-light': '#6d9dc5',    // A lighter, sky blue
                'primary-lighter': '#a0c4e3',  // An even lighter, pastel blue
                'primary-dark': '#1c2e4a',     // A very dark navy blue
                'secondary': '#88b04b',        // A vibrant, leafy green
                'secondary-light': '#b7d99c',  // A lighter, soft green
            }
        },
    },

    plugins: [forms],
};
