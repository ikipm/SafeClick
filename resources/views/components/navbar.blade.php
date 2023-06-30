<nav class="navbar">
    <div class="logo">
        <img src="{{ asset('img/logo.webp') }}" alt="Logo">
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
        @if (Request::is('/'))
            @if ($isLoggedIn)
                <a href="/courses">@lang('shared.courses')</a>
            @else
                <a href="/login">@lang('shared.login')</a>
            @endif
        @elseif(Request::is('login'))
            <a href="/">@lang('shared.home')</a>
        @elseif(Request::is('courses'))
            <a href="{{ route('logout') }}">{{ Auth::user()->userName }}</a>
        @else
            <a href="/login">@lang('shared.login')</a>
        @endif
    </div>
</nav>
