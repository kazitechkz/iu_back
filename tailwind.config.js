/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./vendor/wireui/wireui/src/*.php",

      "./vendor/wireui/wireui/ts/**/*.ts",

      "./vendor/wireui/wireui/src/View/**/*.php",

      "./vendor/wireui/wireui/src/WireUi/**/*.php",

      "./vendor/wireui/wireui/src/resources/**/*.blade.php",
  ],
    presets: [
            require('./vendor/wireui/wireui/tailwind.config.js'),
        require("./vendor/wireui/wireui/tailwind.config.js")
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

