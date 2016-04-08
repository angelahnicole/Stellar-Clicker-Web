var elixir = require('laravel-elixir');

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

elixir(function(mix) 
{
    mix.less('app.less');
    mix.less('iframe.less');
    
    mix.scriptsIn('resources/assets/js/jquery', 'public/js/jquery.js');
    mix.scriptsIn('resources/assets/js/bootstrap', 'public/js/bootstrap.js');
    mix.scriptsIn('resources/assets/js/main', 'public/js/app.js');
});
