<!DOCTYPE html>
<html>

<head>
    <title>@lang("shared.title")</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <x-navbar/>
    </header>

    <main>
        <section class="cards-section">
            <div class="container">
                <h2>@lang("courses.courses")</h2>
                <div class="card-container">
                    @for ($i = 1; $i <= 10; $i++)
                        <div class="card">
                            <div class="card-header">
                                <h3>Title {{ $i }}</h3>
                            </div>
                            <img src="{{ asset('img/cybersec.webp') }}" alt="Card Image">
                            <div class="card-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-bar-fill"></div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 My Website. All rights reserved.</p>
        </div>
    </footer>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/platform.css') }}">
</body>

</html>
