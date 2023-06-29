<!DOCTYPE html>
<html>

<head>
    <title>@lang("shared.title")</title>
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
                    @php
                        $locale = app()->getLocale();
                    @endphp
                    {{ strtoupper($locale) }}
                </div>
                <ul class="language-list">
                    @if ($locale == 'cat')
                        <li><a href="{{ url('/locale/es/') }}">ES</a></li>
                        <li><a href="{{ url('/locale/en') }}">EN</a></li>
                    @elseif ($locale == 'es')
                        <li><a href="{{ url('/locale/cat') }}">CAT</a></li>
                        <li><a href="{{ url('/locale/en') }}">EN</a></li>
                    @elseif ($locale == 'en')
                        <li><a href="{{ url('/locale/cat') }}">CAT</a></li>
                        <li><a href="{{ url('/locale/es') }}">ES</a></li>
                    @endif
                </ul>
            </div>
            <div class="login-button">
                <a href="{{route('logout')}}">{{Auth::user()->userName}}</a>
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
                            <img src="{{ asset('img/cybersec.webp') }}" alt="Card Image">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>
