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
        <section class="course-section">
            <div class="course-card">
                <div class="card-header">
                    <h1>Title</h1>
                </div>
                <div class="course-content">
                    <p>
                        <!--content-->
                    </p>
                </div>
                <div class="course-buttons">
                    <button class="button-prev">&#8592; @lang('courses.previous')</button>
                    <button class="button-next">@lang('courses.next') &#8594;</button>
                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/courseView.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>