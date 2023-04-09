/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        customblue: '#2029F3',
        customgreen: '#0FBA68',
        customyellow: '#EAD621',
  
      },
      boxShadow: {
        'cardboxshadow': '1px 2px 8px rgba(0, 0, 0, 0.04);',
      }

    },
   
  },
  plugins: [],
}