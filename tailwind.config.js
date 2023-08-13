/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
  ],
    presets: [
            require('./vendor/wireui/wireui/tailwind.config.js')
    ],
  theme: {
    extend: {},
  },
    corePlugins: {
        aspectRatio: false,
    },
  plugins: [
      require('@tailwindcss/forms'),
      require('@tailwindcss/aspect-ratio'),
      require('@tailwindcss/typography'),
  ],
}

