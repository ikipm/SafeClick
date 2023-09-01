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
            <h2>Add Content</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Content</h3>
                    </div>
                    <div class="content-text">
                        <form method="POST" action="{{ route('admin.addContent', ['id' => $course->id]) }}" enctype="multipart/form-data">
                            @csrf

                            @if(session('success'))
                            <div id="warning-alert-r" class="alert-warning" style="display: block" role="alert">
                                <ul>
                                    <li>{{ session('success')  }}</li>
                                </ul>
                            </div>
                            @endif

                            @if($errors->any())
                            <div id="warning-alert-r" class="alert-warning" style="display: block" role="alert">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <label for="title-cat">Title in catalan</label>
                            <input type="text" id="title-cat" name="title-cat" placeholder="Title in catalan"  required>
                            <label for="title-es">Title in spanish</label>
                            <input type="text" id="title-es" name="title-es" placeholder="Title in spanish" required>
                            <label for="title-en">Title in english</label>
                            <input type="text" id="title-en" name="title-en" placeholder="Title in english" required>
                            <label for="content-cat">Content in catalan</label>
                            <input type="text" id="content-cat" name="content-cat" placeholder="Content in catalan" required>
                            <label for="content-es">Content in spanish</label>
                            <input type="text" id="content-es" name="content-es" placeholder="Content in spanish" required>
                            <label for="content-en">Content in english</label>
                            <input type="text" id="content-en" name="content-en" placeholder="Content in english" required>
                            <button type="submit" id="course-submit">@lang('admin.publish')</button>
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
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/courses.css') }}">
</body>

</html>