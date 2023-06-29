<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('img/logo.webp') }}" alt="Logo"></img>
            </div>
            <div class="language-menu">
                <div class="current-language">
                    @if (app()->getLocale() == 'cat')
                        CAT
                    @elseif(app()->getLocale() == 'es')
                        ES
                    @elseif(app()->getLocale() == 'en')
                        EN
                    @endif
                </div>
                <ul class="language-list">
                    @if (app()->getLocale() == 'cat')
                        <li><a href="{{ url('es') }}">ES</a></li>
                        <li><a href="{{ url('en') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'es')
                        <li><a href="{{ url('cat') }}">CAT</a></li>
                        <li><a href="{{ url('en') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'en')
                        <li><a href="{{ url('cat') }}">CAT</a></li>
                        <li><a href="{{ url('es') }}">ES</a></li>
                    @endif
                </ul>
            </div>
            <div class="login-button">
                <a href="{{ app()->getLocale() }}/login">@lang('shared.login')</a>
            </div>
        </nav>
    </header>

    <section class="hero-section">
        <div class="hero-image">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>@lang('landingPage.welcomeTitle')</h1>
                    <div class="typing-animation">
                        <span id="typed-text"></span>
                    </div>
                </div>
                <div class="hero-button-container">
                    <a href="#" class="hero-button">@lang('landingPage.start')</a>
                </div>
            </div>
        </div>
    </section>

    <section class="why-section">
        <div class="container">
            <h2>@lang('landingPage.why')</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis
                consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat
                enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt
                nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
        </div>
    </section>

    <section class="how-section">
        <div class="container">
            <h2>@lang('landingPage.how')</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis
                consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat
                enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt
                nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
        </div>
    </section>

    <section class="about-section">
        <div class="container">
            <h2>@lang('landingPage.about')</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur sit amet libero et mauris mattis
                consectetur. Nam eget sem ut nunc venenatis fermentum. In eleifend consectetur sapien, vitae volutpat
                enim pulvinar id.</p>
            <p>Morbi rutrum odio vitae elit euismod malesuada. Mauris lacinia rutrum eros, a condimentum erat tincidunt
                nec. Nullam tristique risus eu leo facilisis, a ultricies turpis consectetur.</p>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="{{ asset('img/logo.webp') }}" alt="Logo">
            </div>
            <div class="footer-links">
                <a href="">@lang('shared.home')</a>
                <a href="">@lang('landingPage.aboutUs')</a>
                <a href="">@lang('landingPage.contact')</a>
            </div>
        </div>
        <p>&copy; 2023 Online Academy. All rights reserved.</p>
    </footer>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/landingPage.css') }}">
    <script src="{{ asset('js/landingpage.js') }}"></script>
</body>

</html>
