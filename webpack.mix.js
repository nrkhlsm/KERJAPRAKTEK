const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .js(['resources/js/core/app-lite.js',
         'resources/js/core/app-menu-lite.js'
      ], 'public/restaurant/admin/js')
   .copy('resources/vendors/', 'public/restaurant/admin/vendors')
   .copy('resources/vendors/DataTables', 'public/restaurant/admin/vendors/DataTables')
   .js('resources/js/core/libraries/bootstrap.min.js', 'public/restaurant/admin/js/core/libraries')
   .js('resources/js/core/libraries/jquery.min.js', 'public/restaurant/admin/js/core/libraries')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/scss/bootstrap-extended.scss', 'public/restaurant/admin/css')
   .sass('resources/scss/colors.scss', 'public/restaurant/admin/css')
   .sass('resources/scss/components-lite.scss', 'public/restaurant/admin/css')
   .sass('resources/scss/app-lite.scss', 'public/restaurant/admin/css')
   .sass('resources/scss/vendors.scss', 'public/restaurant/admin/css')
   .sass('resources/scss/core/colors/palette-variables.scss', 'public/restaurant/admin/css/core/colors')
   .sass('resources/scss/core/colors/palette-gradient.scss', 'public/restaurant/admin/css/core/colors')
   .sass('resources/scss/core/colors/palette-switch.scss', 'public/restaurant/admin/css/core/colors')
   .sass('resources/scss/core/colors/palette-tooltip.scss', 'public/restaurant/admin/css/core/colors')
   .sass('resources/scss/core/menu/menu-types/vertical-menu.scss', 'public/restaurant/admin/css/core/menu/menu-types')
   .sass('resources/scss/core/menu/menu-types/vertical-overlay-menu.scss', 'public/restaurant/admin/css/core/menu/menu-types')
   .sass('resources/scss/core/mixins/callout.scss', 'public/restaurant/admin/css/core/mixins')
   .sass('resources/scss/core/mixins/hex2rgb.scss', 'public/restaurant/admin/css/core/mixins')
   .sass('resources/scss/core/mixins/main-menu-mixin.scss', 'public/restaurant/admin/css/core/mixins')
   .sass('resources/scss/core/mixins/transitions.scss', 'public/restaurant/admin/css/core/mixins');
