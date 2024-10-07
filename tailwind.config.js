/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./vendor/wire-elements/modal/resources/views/*.blade.php",
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  options: {
    safelist: {
      pattern: /max-w-(sm|md|lg|xl|2xl|3xl|4xl|5xl|6xl|7xl)/,
      variants: ['sm', 'md', 'lg', 'xl', '2xl']
    }
  },
  theme: {
    extend: {}
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('tailwind-scrollbar')({ nocompatible: true }),
  ],
}

