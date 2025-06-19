const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [])
   .browserSync({
      proxy: '127.0.0.1:8000',
      files: [
         'app/**/*.php',
         'resources/views/**/*.blade.php',
         'resources/js/**/*.js',
         'resources/css/**/*.css'
      ]
   });
