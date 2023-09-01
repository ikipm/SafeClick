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
            <h2>Edit: {{ $course->translations->where('locale', $locale)->first()->title }}</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit course ID: {{ $course->id }}</h3>
                    </div>
                    <div class="content-text">
                        <form method="POST" action="{{ route('admin.editCourse', ['id' => $course->id]) }}" enctype="multipart/form-data">
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
                            <input type="text" id="course-nameCat" name="course-nameCat" placeholder="@lang('admin.course-title-cat')" value="{{ $course->translations->where('locale', 'cat')->first()->title }}" required>
                            <label for="course-nameEs">@lang('admin.course-title-es')</label>
                            <input type="text" id="course-nameEs" name="course-nameEs" placeholder="@lang('admin.course-title-es')" value="{{ $course->translations->where('locale', 'es')->first()->title }}" required>
                            <label for="course-nameEn">@lang('admin.course-title-en')</label>
                            <input type="text" id="course-nameEn" name="course-nameEn" placeholder="@lang('admin.course-title-en')" value="{{ $course->translations->where('locale', 'en')->first()->title }}" required>
                            <label for="course-descriptionCat">@lang('admin.course-desc-cat')</label>
                            <input type="text" id="course-descriptionCat" name="course-descriptionCat" placeholder="@lang('admin.course-desc-cat')" value="{{ $course->translations->where('locale', 'cat')->first()->description }}" required>
                            <label for="course-descriptionEs">@lang('admin.course-desc-es')</label>
                            <input type="text" id="course-descriptionEs" name="course-descriptionEs" placeholder="@lang('admin.course-desc-es')" value="{{ $course->translations->where('locale', 'es')->first()->description }}" required>
                            <label for="course-descriptionEn">@lang('admin.course-desc-en')</label>
                            <input type="text" id="course-descriptionEn" name="course-descriptionEn" placeholder="@lang('admin.course-desc-en')" value="{{ $course->translations->where('locale', 'en')->first()->description }}" required>
                            <label for="course-image">@lang('admin.course-image')</label>
                            <input type="file" id="course-image" name="course-image" accept="image/*"><br />
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