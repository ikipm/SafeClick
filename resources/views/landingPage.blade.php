<!DOCTYPE html>
@if (app()->getLocale() == 'cat')
<html lang="ca">
@elseif (app()->getLocale() == 'es')
<html lang="es">
@elseif (app()->getLocale() == 'en')
<html lang="en">
@endif

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('shared.title')</title>
    <meta name="description" content="@lang('landingPage.description')">
    <meta name="keywords" content="@lang('landingPage.keywords')">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landingPage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Social media -->
    <meta property="og:title" content="@lang('shared.title')">
    <meta property="og:description" content="@lang('landingPage.description')">
    <meta property="og:image" content="{{ asset('img/logo.webp') }}">
    <meta name="twitter:card" content="{{ asset('img/cybersecurity.webp') }}">
</head>

<body>
    <header class="navbar">
        <x-navbar :isLoggedIn="Auth::check()" />
    </header>

    <section class="hero-section" aria-label="SafeClick Header">
        <div class="hero-content">
            <h1 class="hero-title">SafeClick</h1>
            <p class="hero-subtitle">@lang('landingPage.subtitle')</p>
            <div class="typing-animation">
                <span id="typed-text"></span>
            </div>
            <div class="social-media-container">
                <a href="https://github.com/ikipm/SafeClick" target="_blank">
                    <svg width="40" height="40" viewBox="0 0 98 96" xmlns="http://www.w3.org/2000/svg" class="hero-socialmedia">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M48.854 0C21.839 0 0 22 0 49.217c0 21.756 13.993 40.172 33.405 46.69 2.427.49 3.316-1.059 3.316-2.362 0-1.141-.08-5.052-.08-9.127-13.59 2.934-16.42-5.867-16.42-5.867-2.184-5.704-5.42-7.17-5.42-7.17-4.448-3.015.324-3.015.324-3.015 4.934.326 7.523 5.052 7.523 5.052 4.367 7.496 11.404 5.378 14.235 4.074.404-3.178 1.699-5.378 3.074-6.6-10.839-1.141-22.243-5.378-22.243-24.283 0-5.378 1.94-9.778 5.014-13.2-.485-1.222-2.184-6.275.486-13.038 0 0 4.125-1.304 13.426 5.052a46.97 46.97 0 0 1 12.214-1.63c4.125 0 8.33.571 12.213 1.63 9.302-6.356 13.427-5.052 13.427-5.052 2.67 6.763.97 11.816.485 13.038 3.155 3.422 5.015 7.822 5.015 13.2 0 18.905-11.404 23.06-22.324 24.283 1.78 1.548 3.316 4.481 3.316 9.126 0 6.6-.08 11.897-.08 13.526 0 1.304.89 2.853 3.316 2.364 19.412-6.52 33.405-24.935 33.405-46.691C97.707 22 75.788 0 48.854 0z" fill="#fff"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/safeclick.cat" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0,0,256,256" width="45px" height="45px" class="hero-socialmedia"><g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(10.66667,10.66667)"><path d="M8,3c-2.757,0 -5,2.243 -5,5v8c0,2.757 2.243,5 5,5h8c2.757,0 5,-2.243 5,-5v-8c0,-2.757 -2.243,-5 -5,-5zM8,5h8c1.654,0 3,1.346 3,3v8c0,1.654 -1.346,3 -3,3h-8c-1.654,0 -3,-1.346 -3,-3v-8c0,-1.654 1.346,-3 3,-3zM17,6c-0.55228,0 -1,0.44772 -1,1c0,0.55228 0.44772,1 1,1c0.55228,0 1,-0.44772 1,-1c0,-0.55228 -0.44772,-1 -1,-1zM12,7c-2.757,0 -5,2.243 -5,5c0,2.757 2.243,5 5,5c2.757,0 5,-2.243 5,-5c0,-2.757 -2.243,-5 -5,-5zM12,9c1.654,0 3,1.346 3,3c0,1.654 -1.346,3 -3,3c-1.654,0 -3,-1.346 -3,-3c0,-1.654 1.346,-3 3,-3z"></path></g></g></svg>
                </a>
            </div>
            <a href="/login" class="hero-button">Inicia sessió</a>
            <a href="{{ route('loginTest') }}" class="hero-button">Prova-ho</a>
        </div>
    </section>

    <section class="feature-section">
        <div class="feature-container">
            <div class="feature">
                <i class="fas fa-desktop fa-3x"></i>
                <h3>@lang('landingPage.feature1Title')</h3>
                <p>@lang('landingPage.feature1Desc')</p>
            </div>
            <div class="feature">
                <i class="far fa-check-square fa-3x"></i>
                <h3>@lang('landingPage.feature2Title')</h3>
                <p>@lang('landingPage.feature2Desc')</p>
            </div>
            <div class="feature">
                <i class="fas fa-check-circle fa-3x"></i>
                <h3>@lang('landingPage.feature3Title')</h3>
                <p>@lang('landingPage.feature3Desc')</p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2>@lang('landingPage.about')</h2>
            <p>@lang('landingPage.aboutDesc')</p>
        </div>
    </section>

    <section class="collaborators-section">
        <div class="container">
            <h2>@lang('landingPage.collaborators')</h2>
            <div class="collaborators-container">
                <img src="https://dotacio.fundacio.cat/wp-content/uploads/2022/10/fundacio-300x97.png" alt="Collaborator 1">
                <img src="https://dotacio.fundacio.cat/wp-content/uploads/2023/02/dinahosting-e1676293773743-300x74.png" alt="Collaborator 2">
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-links">
                <a href="">@lang('shared.home')</a>
                <a href="#about-section">@lang('landingPage.aboutUs')</a>
                <a href="mailto:info@safeclick.cat">@lang('landingPage.contact')</a>
            </div>
        </div>
        <p>SafeClick.cat © 2023 by Iker Pérez is licensed under <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/?ref=chooser-v1">CC BY-NC-SA 4.0</a></p>
    </footer>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cookieconsent@3.1.1/build/cookieconsent.min.css">
    <script src="https://cdn.jsdelivr.net/npm/cookieconsent@3.1.1/build/cookieconsent.min.js"></script>
    <script>
        window.addEventListener("load", function() {
            window.cookieconsent.initialise({
                "palette": {
                    "popup": {
                        "background": "#ffffff",
                        "text": "#000000"
                    },
                    "button": {
                        "background": "#1abc9c",
                        "text": "#ffffff"
                    }
                },
                "content": {
                    "message": "@lang('landingPage.cookiesDesc')",
                    "dismiss": "@lang('landingPage.cookiesButton')",
                    "link": "@lang('landingPage.cookiesInfo')"
                }
            });
        });
    </script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
    </script>
    <script src="{{ asset('js/landingpage.js') }}"></script>
</body>

</html>