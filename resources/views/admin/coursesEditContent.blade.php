<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include SimpleMDE CSS and JavaScript -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
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
            <h2>@lang('admin.add-content')</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>{{$course->translations->where('locale', $locale)->first()->title}}</h3>
                    </div>
                    <div class="content-text">
                        <form method="POST" action="{{ route('admin.editContent', ['id' => $course->id, 'contentId' => $content->first()->content_id]) }}" enctype="multipart/form-data">
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
                            <label for="title-cat">@lang('admin.course-title-cat')</label>
                            <input type="text" id="title-cat" name="title-cat" placeholder="@lang('admin.course-title-cat')" value="{{$content->where('locale', 'cat')->first()->title}}" required>
                            <label for="title-es">@lang('admin.course-title-es')</label>
                            <input type="text" id="title-es" name="title-es" placeholder="@lang('admin.course-title-es')" value="{{$content->where('locale', 'es')->first()->title}}" required>
                            <label for="title-en">@lang('admin.course-title-en')</label>
                            <input type="text" id="title-en" name="title-en" placeholder="@lang('admin.course-title-en')" value="{{$content->where('locale', 'en')->first()->title}}" required>
                            <label for="content-cat">@lang('admin.content-cat')</label>
                            <textarea class="markdown-editor" id="content-cat" name="content-cat" placeholder="@lang('admin.content-cat')">{{$content->where('locale', 'cat')->first()->content}}</textarea>
                            <label for="content-es">@lang('admin.content-es')</label>
                            <textarea class="markdown-editor" id="content-es" name="content-es" placeholder="@lang('admin.content-es')">{{$content->where('locale', 'es')->first()->content}}</textarea>
                            <label for="content-en">@lang('admin.content-en')</label>
                            <textarea class="markdown-editor" id="content-en" name="content-en" placeholder="@lang('admin.content-en')">{{$content->where('locale', 'en')->first()->content}}</textarea>
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

    <script>
        // Initialize SimpleMDE for each textarea with the "markdown-editor" class
        var editors = document.querySelectorAll('.markdown-editor');
        editors.forEach(function(editor) {
            new SimpleMDE({
                element: editor
            });
        });
    </script>
</body>

</html>