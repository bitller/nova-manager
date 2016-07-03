var elixir = require('laravel-elixir');
require('laravel-elixir-vueify');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('node_modules/sweetalert/dist/sweetalert.css', 'resources/assets/sass/sweetalert.scss');
    mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');
    mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css', 'resources/assets/sass/bootstrap-datepicker3.scss');
    // mix.copy('node_modules/trumbowyg/dist/ui/trumbowyg.min.css', 'public/css/trumbowyg.css');
    // mix.copy('node_modules/trumbowyg/dist/ui/icons.svg', 'public/js/ui/icons.svg');
    mix.copy('node_modules/medium-editor/dist/css/medium-editor.min.css', 'public/css/medium-editor.css');
    mix.copy('node_modules/medium-editor/dist/css/themes/flat.min.css', 'public/css/flat.css');
    mix.sass('app.scss');
    mix.browserify('app.js');
});
