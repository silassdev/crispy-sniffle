/** @type {import('tailwindcss').Config} */
export const content = [
  '../../vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
  '../../storage/framework/views/*.php',
  '../**/*.blade.php',
  '../**/*.js', 
];
export const theme = {
  extend: {
    fontFamily: {
      sans: ['Roboto', 'sans-serif'],
    },
  },
};
export const plugins = [];