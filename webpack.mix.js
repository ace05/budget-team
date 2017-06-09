const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.copyDirectory('resources/assets/images', 'public/images');
mix.sass('resources/assets/stylesheets/app/app.scss', 'public/css/app.css').version();
mix.scripts([
	'resources/assets/javascripts/jquery.js',
    'resources/assets/javascripts/bootstrap.js',
    'resources/assets/javascripts/sweetalert.js',
    'resources/assets/javascripts/ie10-viewport-bug-workaround.js',
    'resources/assets/javascripts/app/app.js'
], 'public/js/app.js').version();
