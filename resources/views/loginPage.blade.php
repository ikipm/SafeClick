<!DOCTYPE html>
<html>

<head>
    <title>@lang('loginPage.title') - @lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginPage.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="{{ asset('img/logo.png') }}" alt="Logo">
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
                        <li><a href="{{ url('/es/login/') }}">ES</a></li>
                        <li><a href="{{ url('/en/login') }}">EN</a></li>
                    @elseif ($locale == 'es')
                        <li><a href="{{ url('/cat/login') }}">CAT</a></li>
                        <li><a href="{{ url('/en/login') }}">EN</a></li>
                    @elseif ($locale == 'en')
                        <li><a href="{{ url('/cat/login') }}">CAT</a></li>
                        <li><a href="{{ url('/es/login') }}">ES</a></li>
                    @endif
                </ul>
            </div>
            <div class="login-button">
                <a href="{{ url($locale) }}">@lang('shared.home')</a>
            </div>
        </nav>
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>@lang('loginPage.register')</h2>
            @if ($errors->any() && !$errors->has("errorLogin"))
                <div id="warning-alert-r" class="alert-warning" style="display: block" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @else
                <div id="warning-alert-r" class="alert-warning d-none" style="display: none" role="alert"></div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <label for="register-name">@lang('loginPage.name')</label>
                <input type="text" id="register-name" name="name" placeholder="@lang('loginPage.insertName')" required>
                <label for="register-user">@lang('loginPage.userName')</label>
                <input type="text" id="register-user" name="userName" placeholder="@lang('loginPage.insertUserName')" required>
                <label for="register-email">@lang('loginPage.email')</label>
                <input type="email" id="register-email" name="email" placeholder="@lang('loginPage.insertEmail')" required>
                <label for="register-password">@lang('loginPage.password')</label>
                <input type="password" id="register-password" name="password" placeholder="@lang('loginPage.insertPassword')" required>
                <input type="password" id="register-password2" name="password2" placeholder="@lang('loginPage.insertPasswordConfirmation')" required>
                <button type="submit" id="register-submit">@lang('loginPage.register')</button>
            </form>
        </div>
        <div class="login-container">
            <h2>@lang('loginPage.login')</h2>
            @if ($errors->has("errorLogin"))
                <div id="warning-alert-l" class="alert-warning" style="display: block" role="alert">{{ $errors->first("errorLogin") }}</div>
            @else
                <div id="warning-alert-l" class="alert-warning d-none" style="display: none" role="alert"></div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <label for="login-email">@lang('loginPage.email')</label>
                <input type="email" id="login-email" name="email" placeholder="@lang('loginPage.insertEmail')" required>
                <label for="login-password">@lang('loginPage.password')</label>
                <input type="password" id="login-password" name="password" placeholder="@lang('loginPage.insertPassword')" required>
                <button type="submit">@lang('loginPage.login')</button>
            </form>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginPage.css') }}">
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ asset('js/loginpage.js') }}"></script>
</body>

</html>
