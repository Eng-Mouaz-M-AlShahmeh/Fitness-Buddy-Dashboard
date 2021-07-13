const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/day.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/day.css');

if (mix.inProduction()) {
    mix.version();
}