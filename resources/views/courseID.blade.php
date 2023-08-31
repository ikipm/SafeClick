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
        @endphp
        <section class="cards-section">
            <div class="container">
                <h2>{{ $course->translations->where('locale', $locale)->first()->title }}</h2>
            </div>
        </section>
    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>