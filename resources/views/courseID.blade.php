<!DOCTYPE html>
@php
use Illuminate\Support\Facades\Session;
$locale = Session::get('locale', 'cat');
$content = $content->where('locale', $locale)->first();
$parsedown = new Parsedown();
$parsedContent = $parsedown->text($content->content);
@endphp

<head>
    <title>{{ $content->title }} - @lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <x-navbar />
    </header>
    <main>
        <section class="course-section">
            <div class="course-card">
                <div class="card-header">
                    <h1>{{ $content->title }}</h1>
                </div>
                <div class="course-content">
                    <div id="parsed-content" data-content="{{ json_encode($parsedContent) }}" style="display: none;"></div>
                </div>
                <div class="course-buttons">
                    @if($content->content_id !== 1)
                    <a href="/courses/{{ $content->course_id }}/{{ $content->content_id - 1 }}" class="button-prev">&#8592; @lang('courses.previous')</a>
                    @endif
                    @if($content->content_id !== $course->contents->count() / 3)
                    <a href="/courses/{{ $content->course_id }}/{{ $content->content_id + 1 }}" class="button-next">@lang('courses.next') &#8594;</a>
                    @endif
                </div>
            </div>
        </section>
        <div class="alert-container">
            <div id="warning-alert" class="alert-warning" role="alert"></div>
        </div>
    </main>
    <a class="fixed-button" href="/courses">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#fff">
            <path d="M12 2L0 12h3v10h18V12h3z" />
            <path fill="none" d="M0 0h24v24H0z" />
        </svg>
    </a>
    <script src="{{ asset('messages.js') }}"></script>
    <script>
        // Pass the locale value to JavaScript
        var currentLocale = "{{ app()->getLocale() }}";
        var isLastVisitedContent = "{{ ($userProgress->last_content_id ?? $content->content_id) == $content->content_id }}";
    </script>
    <script src="{{ asset('js/courses.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/courseView.css') }}" type="text/css">
</body>

</html>