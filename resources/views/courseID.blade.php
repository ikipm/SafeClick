<!DOCTYPE html>
<html>

<head>
    <title>@lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <x-navbar />
    </header>
    <main>
        @php
        use Illuminate\Support\Facades\Session;
        $locale = Session::get('locale', 'cat');
        $content = $content->where('locale', $locale)->first();
        $parsedown = new Parsedown(); // Create a Parsedown instance
        $parsedContent = $parsedown->text($content->content); // Parse the Markdown content
        @endphp
        <section class="course-section">
            <div class="course-card">
                <div class="card-header">
                    <h1>{{$content->title}}</h1>
                </div>
                <div class="course-content">
                    <p>
                        {!!$parsedContent!!}
                    </p>
                </div>
                <div class="course-buttons">
                    @if($content->content_id !== 1)
                    <a href="/courses/{{$content->course_id}}/{{$content->content_id - 1}}" class="button-prev">&#8592; @lang('courses.previous')</a>
                    @endif
                    @if($content->content_id !== $content->count() / 3)
                        <a href="/courses/{{$content->course_id}}/{{$content->content_id + 1}}" class="button-next">@lang('courses.next') &#8594;</a>
                    @endif
                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/courseView.css') }}">
</body>

</html>