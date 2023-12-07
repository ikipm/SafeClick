<!DOCTYPE html>
@if (app()->getLocale() == 'cat')
<html lang="ca">
@elseif (app()->getLocale() == 'es')
<html lang="es">
@elseif (app()->getLocale() == 'en')
<html lang="en">
@endif

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landingPage.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@lang('landingPage.description')">
    <meta name="keywords" content="@lang('landingPage.keywords')">
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
            <a href="/login" class="hero-button">@lang('landingPage.start')</a>
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
        <p>SafeClick.cat © 2023 by Iker Pérez is licensed under <a href="https://creativecommons.org/licenses/by/4.0/?ref=chooser-v1">CC BY 4.0</a></p>
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