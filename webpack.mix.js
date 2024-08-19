const mix = require('laravel-mix');
const mixF = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//  backend assets
mix.js('resources/js/Backend/app.js', 'public/js/backend').vue()
    .postCss('resources/css/backend/app.css', 'public/css/backend', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .alias({
        '@': 'resources/js/Backend',
    });

if (mix.inProduction()) {
    mix.version();
}

// frontend assets
mixF.js('resources/js/Frontend/app.js', 'public/js/frontend').vue()
    .postCss('resources/css/frontend/app.css', 'public/css/frontend', [
        require('postcss-import'),
        require('tailwindcss'),
    ])
    .alias({
        '@@': 'resources/js/Frontend',
    });

if (mixF.inProduction()) {
    mixF.version();
}
