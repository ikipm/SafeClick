<!DOCTYPE html>
<html>

<head>
    <title>@lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo"></img>
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
                        <li><a href="{{ url('/es/courses/') }}">ES</a></li>
                        <li><a href="{{ url('/en/courses') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'es')
                        <li><a href="{{ url('/cat/courses') }}">CAT</a></li>
                        <li><a href="{{ url('/en/courses') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'en')
                        <li><a href="{{ url('/cat/courses') }}">CAT</a></li>
                        <li><a href="{{ url('/es/courses') }}">ES</a></li>
                    @endif
                </ul>
            </div>
            <div class="login-button">
                <a href="{{route("logout")}}">Username</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="cards-section">
            <div class="container">
                <h2>@lang("courses.courses")</h2>
                <div class="card-container">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="card">
                            <div class="card-header">
                                <h3>Title {{ $i }}</h3>
                            </div>
                            <img src="{{ asset('img/cybersec.png') }}" alt="Card Image">
                            <div class="card-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-bar-fill"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 My Website. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>
