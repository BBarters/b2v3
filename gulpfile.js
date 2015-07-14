var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

var paths = {
    'bower_base_path': './bower_components/',
    'bootstrap': './bower_components/bootstrap-material-design/'
};

elixir(function(mix) {
    mix.sass('*.scss','css/style.css');
    mix.coffee('*.coffee','js/script.js');
});