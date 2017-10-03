let mix = require('laravel-mix');

const assetsPath = 'public/assets/';

mix
    // Sass / Css files...
    .sass('resources/assets/sass/frontend/frontend.scss', assetsPath + 'css/').options({
        processCssUrls: false
    })

    .sass('resources/assets/sass/backend/backend.scss', assetsPath + 'css/').options({
        processCssUrls: false
    })

    .styles('resources/assets/talvbansal/media-manager/css/media-manager.css', assetsPath + 'css/media-manager.css')

    // Front end js files...
    .scripts([
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/bootstrap.min.js',
        'resources/assets/js/frontend/**/*.js',
    ], assetsPath + 'js/frontend.js')

    // Vendor js files...
    .scripts([
        'resources/assets/js/jquery.min.js',
        'resources/assets/js/bootstrap.min.js',
        'resources/assets/js/moment.min.js',
        'resources/assets/js/simplemde.min.js',
        'resources/assets/js/autosize.min.js',
        'resources/assets/js/bootstrap-select.js',
        'resources/assets/js/jquery.mask.min.js',
        'resources/assets/js/chosen.jquery.min.js',
        'resources/assets/js/jquery.bootgrid.min.js',
        'resources/assets/js/lightgallery.min.js',
        'resources/assets/js/waves.js',
        'resources/assets/js/jquery.mCustomScrollbar.concat.min.js',
        'resources/assets/js/fileinput.min.js',
        'resources/assets/js/bootstrap-datetimepicker.min.js',
        'resources/assets/talvbansal/media-manager/js/media-manager.js'
    ], assetsPath + 'js/vendor.js')

    .scripts([
        'resources/assets/js/functions.js',
        'resources/assets/js/bootstrap-growl.min.js'
    ], assetsPath + 'js/app.js')

    .copy([
        'resources/assets/fonts',
        'resources/assets/talvbansal/media-manager/fonts'
    ], assetsPath + '/fonts');
