<!DOCTYPE html>
<html>

<head>
    <title>@lang('loginPage.title') - @lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <x-navbar />
    </header>
    <div class="container-wrapper">
        <div class="register-container">
            <h2>@lang('loginPage.register')</h2>
            @if(request('verify') === 'yes')
            <div id="warning-alert-r" class="alert-warning" style="display: block" role="alert">
                <p>@lang('loginPage.verifyEmail')</p>
            </div>
            @endif
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
                <div class="form-group">
                    <input type="checkbox" id="privacy-checkbox" name="privacy" required>
                    <label for="privacy-checkbox">@lang('loginPage.privacy')</label>
                    <a href="/privacy-policy">@lang('loginPage.privacyLink')</a>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="terms-checkbox" name="terms" required>
                    <label for="terms-checkbox">@lang('loginPage.terms')</label>
                    <a href="/terms-conditions">@lang('loginPage.termsLink')</a>
                </div>
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
            <hr class="divider">
            <div class="continue-as-guest">
                <h3>@lang('loginPage.loginTest')</h3>
                <p>@lang('loginPage.loginTestDescription')</p>
                <a href="{{ route('loginTest') }}" class="guest-link">@lang('loginPage.loginTest')</a>
            </div>
        </div>
    </div>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loginPage.css') }}">
    <script src="{{ asset('messages.js') }}"></script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
    </script>
    <script src="{{ asset('js/loginpage.js') }}"></script>
</body>

</html>