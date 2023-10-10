let mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')

require('./mix')

mix
    .setPublicPath('dist')
    .js('resources/js/field.js', 'js')
    .vue({version: 3})
    .postCss("resources/css/field.css", "css", [tailwindcss("tailwind.config.js")])
    .nova('henryavila/laravel-nova-chordpro-field')
