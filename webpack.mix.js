const mix = require('laravel-mix');
// const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

// const CaseSensitivePathsPlugin = require('case-sensitive-paths-webpack-plugin');

// var webpackConfig = {
//     plugins: [
//         new VuetifyLoaderPlugin(),
//         new CaseSensitivePathsPlugin()
//         // other plugins ...
//     ]
//     // other webpack config ...

// }

// mix.webpackConfig( webpackConfig );
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
/*mix.setPublicPath('public');
mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css').sourceMaps()
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();
*/

mix.config.webpackConfig.output = {
    chunkFilename: 'js/[name].ebox.js',
    publicPath: '/',
};

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version().sourceMaps();
