<!DOCTYPE html>
<html>

<head>
    <title>@lang("loginPage.title") - @lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginPage.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
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
                        <li><a href="{{ url('/es/login/') }}">ES</a></li>
                        <li><a href="{{ url('/en/login') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'es')
                        <li><a href="{{ url('/cat/login') }}">CAT</a></li>
                        <li><a href="{{ url('/en/login') }}">EN</a></li>
                    @elseif(app()->getLocale() == 'en')
                        <li><a href="{{ url('/cat/login') }}">CAT</a></li>
                        <li><a href="{{ url('/es/login') }}">ES</a></li>
                    @endif
                </ul>
            </div>
            <div class="login-button">
                <a href="/">@lang("shared.home")</a>
            </div>
        </nav>
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>@lang("loginPage.register")</h2>
            <form>
                <label for="register-user">@lang("loginPage.userName")</label>
                <input type="text" id="register-user" placeholder="{{@lang("loginPage.insetUserName")}}" required>
                <label for="register-email">@lang("loginPage.email")</label>
                <input type="email" id="register-email" placeholder="{{@lang("loginPage.insertEmail")}}" required>
                <label for="register-password">@lang("loginPage.password")</label>
                <input type="password" id="register-password" placeholder="{{@lang("loginPage.insertPassword")}}" required>
                <button type="submit">@lang("loginPage.register")</button>
            </form>
        </div>
        <div class="login-container">
            <h2>@lang("loginPage.login")</h2>
            <form>
                <label for="login-email">@lang("loginPage.email")</label>
                <input type="email" id="login-email" placeholder="{{@lang("loginPage.insertEmail")}}" required>
                <label for="login-password">@lang("loginPage.password")</label>
                <input type="password" id="login-password" placeholder="{{@lang("loginPage.insertPassword")}}" required>
                <button type="submit">@lang("loginPage.login")</button>
            </form>
        </div>
    </div>
</body>

</html>
