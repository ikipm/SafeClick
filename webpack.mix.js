const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js("resources/js/courses.js", "public/js")
    .js("resources/js/contentinfo.js", "public/js")
    .js("resources/js/landingpage.js", "public/js")
    .js("resources/js/loginpage.js", "public/js")
    .js("resources/js/sideBar.js", "public/js")
    .js("resources/js/snow.js", "public/js")
    .js("resources/js/alert.js", "public/js")
    .postCss("resources/css/admin.css", "public/css")
    .postCss("resources/css/courseView.css", "public/css")
    .postCss("resources/css/landingPage.css", "public/css")
    .postCss("resources/css/loginPage.css", "public/css")
    .postCss("resources/css/platform.css", "public/css")
    .postCss("resources/css/shared.css", "public/css")
    .postCss("resources/css/sideBar.css", "public/css")
    .postCss("resources/css/admin/courseAdd.css", "public/css/admin")
    .postCss("resources/css/admin/courses.css", "public/css/admin")
    .postCss("resources/css/admin/logs.css", "public/css/admin")
    .postCss("resources/css/admin/users.css", "public/css/admin")
    .postCss("resources/css/admin/courseContentInfo.css", "public/css/admin")
    .postCss("resources/css/snow.css", "public/css");
