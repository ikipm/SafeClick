<nav class="navbar">
    <a href="/">
        <div class="logo">
            <img src="{{ asset('img/logo.webp') }}" alt="Logo">
        </div>
    </a>
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
    @if(Auth::user())
    <div class="admin-button">
        @if (Auth::user()->admin and !Request::is('admin*'))
        <a href="{{ route('admin') }}">@lang('admin.adminButton')</a>
        @elseif(Auth::user()->admin and Request::is('admin*'))
        <a href="/courses">@lang('courses.courses')</a>
        @endif
    </div>
    @endif
    <div class="login-button">
        @if (Request::is('/'))
        @if (Auth::user())
        <a href="/courses">@lang('courses.courses')</a>
        @else
        <a href="/login">@lang('shared.login')</a>
        @endif
        @elseif(Request::is('login'))
        <a href="/">@lang('shared.home')</a>
        @elseif(Request::is('courses*') or Request::is('admin*'))
        <a href="{{ route('logout') }}">{{ Auth::user()->userName }}</a>
        @else
        <a href="/login">@lang('shared.login')</a>
        @endif
    </div>
</nav>