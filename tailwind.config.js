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
        "dark-blue": '#2029F3',
        'dark-green': '#0FBA68',
        'dark-yellow': '#EAD621',
  
      },  
      boxShadow: {
        "input-box-shadow-blue": "-3px 3px 0px #DBE8FB, -3px -3px 0px #DBE8FB, 3px -3px 0px #DBE8FB, 3px 3px 0px #DBE8FB, 3px 3px 0px #DBE8FB"
      }
    },
   
  },
  plugins: [],
}