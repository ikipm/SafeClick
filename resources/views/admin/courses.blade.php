<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <x-navbar />
    </header>

    <x-admin-side-bar />

    <main>
        @php
        $courses = session('courses');
        @endphp
        <div class="container">
            <h2>@lang('admin.courses')</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.create-course')</h3>
                    </div>
                    <div class="content-text">
                        <form method="POST" action="{{ route('admin.createCourse') }}" enctype="multipart/form-data">
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
                            <label for="course-nameCat">@lang('admin.course-title-cat')</label>
                            <input type="text" id="course-nameCat" name="course-nameCat" placeholder="@lang('admin.course-title-cat')" required>
                            <label for="course-nameEs">@lang('admin.course-title-es')</label>
                            <input type="text" id="course-nameEs" name="course-nameEs" placeholder="@lang('admin.course-title-es')" required>
                            <label for="course-nameEn">@lang('admin.course-title-en')</label>
                            <input type="text" id="course-nameEn" name="course-nameEn" placeholder="@lang('admin.course-title-en')" required>
                            <label for="course-descriptionCat">@lang('admin.course-desc-cat')</label>
                            <input type="text" id="course-descriptionCat" name="course-descriptionCat" placeholder="@lang('admin.course-desc-cat')" required>
                            <label for="course-descriptionEs">@lang('admin.course-desc-es')</label>
                            <input type="text" id="course-descriptionEs" name="course-descriptionEs" placeholder="@lang('admin.course-desc-es')" required>
                            <label for="course-descriptionEn">@lang('admin.course-desc-en')</label>
                            <input type="text" id="course-descriptionEn" name="course-descriptionEn" placeholder="@lang('admin.course-desc-en')" required>
                            <label for="course-image">@lang('admin.course-image')</label>
                            <input type="file" id="course-image" name="course-image" accept="image/*" required><br />
                            <button type="submit" id="course-submit">@lang('admin.publish')</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.search-course')</h3>
                    </div>
                    <div class="content-text">
                        <form method="GET" action="{{ route('admin.searchCourse') }}">
                            @csrf
                            <label for="course-name">@lang('admin.course-name')</label>
                            <input type="text" id="course-name" name="course-name" placeholder="@lang('admin.course-name')">
                            <label for="id">ID:</label>
                            <input type="text" id="id" name="id" placeholder="@lang('admin.course-id')">
                            <button type="submit" id="search">@lang('admin.search')</button>
                        </form>
                    </div>
                    @if($courses)
                    <div class="result">
                        <ul class="course-list">
                            @isset($courses)
                            @foreach ($courses as $course)
                            <li>
                                <span class="course-title">{{ $course->translations->where('locale', app()->getLocale())->first()->title }} | ID: {{ $course->id }}</span>
                                <div class="course-buttons">
                                    <a class="course-button-notworking">@lang('admin.info')</a>
                                    <a class="course-button" href="/admin/courses/edit/{{$course->id}}">@lang('admin.edit')</a>
                                    <a class="course-button" href="/admin/courses/content/{{$course->id}}">@lang('admin.content')</a>
                                </div>
                            </li>
                            @endforeach
                            @endisset
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
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/courses.css') }}">

</html>