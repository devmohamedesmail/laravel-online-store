/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: '#FF0000',
        secondary: '#00cc66',
        tertiary: '#00cc66',
      },
    },
  },
  plugins: [],
}

