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
        use App\Models\Course;
        $courses = Course::all();
        @endphp
        
        <section class="cards-section">
            <div class="container">
                <h2>@lang("courses.courses")</h2>
                <div class="card-container">
                    @foreach ($courses as $course)
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $course->title }}</h3>
                        </div>
                        <img src="{{ asset('img/cybersec.webp') }}" alt="Card Image">
                        <div class="card-description">
                            <p>{{ $course->description }}</p>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>