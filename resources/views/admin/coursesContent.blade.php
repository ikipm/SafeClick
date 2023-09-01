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
        use Illuminate\Support\Facades\Session;
        $locale = Session::get('locale', 'cat');
        @endphp
        <div class="container">
            <h2>Users</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>Create a user</h3>
                    </div>
                    <div class="content-text">
                        <ul class="content-list">
                            @foreach ($course->contents->where('locale', $locale) as $content)
                            <li>
                                <span class="content-name">{{$content->title}}</span>
                                <div class="content-buttons">
                                    <a class="content-button" href="">@lang('admin.info')</a>
                                    <a class="content-button" href="">@lang('admin.edit')</a>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <a class="fixed-button" href="/admin/courses/content/add/{{$course->id}}">+</a>

    <script src="{{ asset('messages.js') }}"></script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
    </script>
    <script src="{{ asset('js/loginpage.js') }}"></script>
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/courseAdd.css') }}">

</html>