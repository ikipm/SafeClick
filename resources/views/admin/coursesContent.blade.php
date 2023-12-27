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
        use Illuminate\Support\Facades\Session;
        $locale = Session::get('locale', 'cat');
        @endphp
        <div class="container">
            <h2>@lang('admin.content')</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>{{$course->translations->where('locale', $locale)->first()->title}}</h3>
                    </div>
                    <div class="content-text">
                        <ul class="content-list">
                            @foreach ($course->contents->where('locale', $locale) as $content)
                            <li>
                                <span class="content-name">{{$content->title}}</span>
                                <div class="content-buttons">
                                    <a class="content-button contentInfo-button" href="#" data-content-id="{{ $content->content_id }}" data-content-title="{{ $content->title }}" data-content="{{$content->content}}">@lang('admin.info')</a>
                                    <a class="content-button" href="/admin/courses/content/edit/{{$course->id}}/{{$content->content_id}}">@lang('admin.edit')</a>
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

    <div id="courseInfoModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModalButton">&times;</span>
            <div class="modal-body">
                <div id="courseInfoContent"></div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('messages.js') }}"></script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
    </script>
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <script src="{{ asset('js/contentinfo.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/courseAdd.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/courseContentInfo.css') }}">
</body>

</html>