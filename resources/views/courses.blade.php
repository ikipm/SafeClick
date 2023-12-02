<!DOCTYPE html>
<html>

<head>
    <title>@lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <x-navbar />
    </header>

    <main>
        @php
        use App\Models\UserCourseProgress;
        @endphp

        <section class="cards-section">
            <div class="container">
                <h2>@lang("courses.courses")</h2>
                <div class="card-container">
                    @foreach ($courses as $course)
                    @php
                    $userProgress = UserCourseProgress::where('user_id', auth()->user()->id)
                    ->where('course_id', $course->id)
                    ->first()->last_content_id ?? 0;

                    if ($course->contents->count() !== 0) {
                    $totalContents = $course->contents->count() / 3;
                    $percentageCompleted = ($userProgress / $totalContents) * 100;
                    if ($userProgress < $totalContents) { $userProgress +=1; } } else { $percentageCompleted=100; } @endphp @if ($userProgress==0) <a class="card" style="opacity: 0.5;">
                        <div class="card-header">
                            <h3>{{ $course->translations->where('locale', $locale)->first()->title }}</h3>
                        </div>
                        <img src="{{$course->img}}" alt="Card Image">
                        <div class="card-description">
                            <p>{{ $course->translations->where('locale', $locale)->first()->description }}</p>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: {{$percentageCompleted}}%;"></div>
                        </div>
                        </a>
                        @else
                        <a class="card" href="/courses/{{$course->id}}/{{$userProgress}}">
                            <div class="card-header">
                                <h3>{{ $course->translations->where('locale', $locale)->first()->title }}</h3>
                            </div>
                            <img src="{{$course->img}}" alt="Card Image">
                            <div class="card-description">
                                <p>{{ $course->translations->where('locale', $locale)->first()->description }}</p>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-bar-fill" style="width: {{$percentageCompleted}}%;"></div>
                            </div>
                        </a>
                        @endif
                        @endforeach
                </div>
            </div>
        </section>
    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>