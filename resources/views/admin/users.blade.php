<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <x-navbar />
    </header>

    <x-admin-side-bar />

    <main>
        @php
            use App\Models\User;
            $users = session('users');
        @endphp

        <div class="container">
            <h2>@lang('admin.usersTitle')</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.create-user')</h3>
                    </div>
                    <div class="content-text">
                        @if ($errors->any() && !$errors->has('errorLogin'))
                            <div id="warning-alert-r" class="alert-warning" style="display: block" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <div id="warning-alert-r" class="alert-warning d-none" style="display: none" role="alert">
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.register') }}">
                            @csrf
                            <label for="register-name">@lang('loginPage.name')</label>
                            <input type="text" id="register-name" name="name" placeholder="@lang('loginPage.insertName')"
                                required>
                            <label for="register-user">@lang('loginPage.userName')</label>
                            <input type="text" id="register-user" name="userName" placeholder="@lang('loginPage.insertUserName')"
                                required>
                            <label for="register-email">@lang('loginPage.email')</label>
                            <input type="email" id="register-email" name="email" placeholder="@lang('loginPage.insertEmail')"
                                required>
                            <label for="register-password">@lang('loginPage.password')</label>
                            <input type="password" id="register-password" name="password"
                                placeholder="@lang('loginPage.insertPassword')" required>
                            <input type="password" id="register-password2" name="password2"
                                placeholder="@lang('loginPage.insertPasswordConfirmation')" required>
                            <label for="register-admin">Admin: </label>
                            <input type="checkbox" id="register-admin" name="admin"><br /><br />
                            <button type="submit" id="register-submit">@lang('loginPage.register')</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.search-user')</h3>
                    </div>
                    <div class="content-text">
                        <form method="GET" action="{{ route('admin.search') }}">
                            @csrf
                            <label for="register-name">@lang('loginPage.name')</label>
                            <input type="text" id="register-name" name="name" placeholder="@lang('loginPage.insertName')">
                            <label for="register-user">@lang('loginPage.userName')</label>
                            <input type="text" id="register-user" name="userName" placeholder="@lang('loginPage.insertUserName')">
                            <label for="register-email">@lang('loginPage.email')</label>
                            <input type="email" id="register-email" name="email" placeholder="@lang('loginPage.insertEmail')">
                            <button type="submit" id="register-submit">@lang('admin.search')</button>
                        </form>
                    </div>
                    @if($users)
                        <div class="result">
                            <ul class="user-list">
                                @foreach ($users as $user)
                                    <li>
                                        <span class="user-name">{{ $user->name}} | {{ $user->userName }}</span>
                                        <div class="user-buttons">
                                            <a class="user-button" href="/admin/user/info/{{$user->id}}">@lang('admin.info')</a>
                                            <a class="user-button" href="/admin/user/edit/{{$user->id}}">@lang('admin.edit')</a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('messages.js') }}"></script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
    </script>
    <script src="{{ asset('js/loginpage.js') }}"></script>
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/users.css') }}">

</html>
