import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
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
                // Boutique-inspired color palette
                boutique: {
                    50: '#fefcf9',   // Soft cream
                    100: '#fdf8f0',  // Warm ivory
                    200: '#faf0e1',  // Light beige
                    300: '#f5e4c7',  // Warm sand
                    400: '#eed4a8',  // Golden cream
                    500: '#e6c085',  // Rich gold
                    600: '#d4a85c',  // Warm gold
                    700: '#b88a3a',  // Deep gold
                    800: '#946e2e',  // Dark gold
                    900: '#7a5a28',  // Rich brown-gold
                    950: '#3d2e14',  // Deep brown
                },
                burgundy: {
                    50: '#fdf2f8',   // Soft rose
                    100: '#fce7f3',  // Light rose
                    200: '#fbcfe8',  // Pale rose
                    300: '#f9a8d4',  // Soft pink
                    400: '#f472b6',  // Medium pink
                    500: '#ec4899',  // Rose pink
                    600: '#db2777',  // Deep rose
                    700: '#be185d',  // Burgundy rose
                    800: '#9d174d',  // Deep burgundy
                    900: '#831843',  // Rich burgundy
                    950: '#500724',  // Dark burgundy
                },
                cream: {
                    50: '#fefefe',   // Pure white
                    100: '#fefdfb',  // Soft white
                    200: '#fdfbf7',  // Warm white
                    300: '#fbf7f0',  // Cream white
                    400: '#f8f2e8',  // Light cream
                    500: '#f4ecdd',  // Warm cream
                    600: '#eee2d0',  // Medium cream
                    700: '#e6d4bc',  // Rich cream
                    800: '#d4c0a3',  // Golden cream
                    900: '#b8a285',  // Warm beige
                    950: '#8b6f4d',  // Deep beige
                },
                neutral: {
                    50: '#fafafa',   // Pure white
                    100: '#f5f5f5',  // Light gray
                    200: '#e5e5e5',  // Soft gray
                    300: '#d4d4d4',  // Medium gray
                    400: '#a3a3a3',  // Gray
                    500: '#737373',  // Medium gray
                    600: '#525252',  // Dark gray
                    700: '#404040',  // Charcoal
                    800: '#262626',  // Dark charcoal
                    900: '#171717',  // Near black
                    950: '#0a0a0a',  // Pure black
                }
            },
            backgroundColor: {
                'primary': '#e6c085',    // Boutique gold
                'secondary': '#be185d',   // Burgundy rose
                'accent': '#f4ecdd',      // Warm cream
                'surface': '#fefcf9',     // Soft cream
                'surface-dark': '#171717', // Dark surface
            },
            textColor: {
                'primary': '#7a5a28',    // Rich brown-gold
                'secondary': '#831843',   // Rich burgundy
                'accent': '#d4a85c',     // Warm gold
                'muted': '#737373',      // Medium gray
                'muted-dark': '#a3a3a3', // Light gray for dark mode
            },
            borderColor: {
                'primary': '#e6c085',    // Boutique gold
                'secondary': '#be185d',   // Burgundy rose
                'accent': '#f4ecdd',     // Warm cream
                'muted': '#e5e5e5',      // Soft gray
                'muted-dark': '#404040', // Charcoal for dark mode
            }
        },
    },

    plugins: [forms],
};
