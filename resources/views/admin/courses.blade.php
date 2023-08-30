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
        <div class="container">
            <h2>Courses</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>Create a course</h3>
                    </div>
                    <div class="content-text">
                        <form method="POST" action="{{ route('admin.createCourse') }}">
                            @csrf
                            @if(session('success'))
                            <div class="success-message">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if($errors->any())
                            <div class="error-message">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <label for="course-name">@lang('loginPage.name')</label>
                            <input type="text" id="course-name" name="course-name" placeholder="Course name" required>
                            <label for="course-description">Description</label>
                            <input type="text" id="course-description" name="course-description" placeholder="Course description" required>
                            <button type="submit" id="course-submit">Publish</button>
                        </form>

                    </div>
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