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
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    dark: '#1A3C34', // Deep Forest Green
                    DEFAULT: '#2D5A4C', // Primary Green
                    light: '#A3C9BC', // Sage/Light Green
                    cream: '#F9F9F7', // Organic White/Beige
                    gray: '#F3F4F6', // Soft Gray
                }
            },
            borderRadius: {
                '2xl': '1.25rem', // 20px as per PRD
            }
        },
    },

    plugins: [forms],
};
