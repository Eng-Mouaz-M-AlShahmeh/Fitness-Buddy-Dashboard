const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/nutritionistclass.js')
    .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/nutritionistclass.css');

if (mix.inProduction()) {
    mix.version();
}