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
        <div class="container">
            <h2>Admin log system</h2>
            <div class="card">
                <div class="card-header">
                    <h3>404 codes</h3>
                </div>
                <div class="content-text">
                    @php
                        $logEntries = array_reverse(file(storage_path('logs/404.log')));
                        $perPage = 10;
                        $currentPage = request('page', 1);
                        $offset = ($currentPage - 1) * $perPage;
                        $entriesToShow = array_slice($logEntries, $offset, $perPage);
                    @endphp

                    @foreach($entriesToShow as $line)
                        <p>{{$line}}</p>
                    @endforeach

                    <div class="pagination">
                        @for ($i = 1; $i <= ceil(count($logEntries) / $perPage); $i++)
                            <a href="?page={{ $i }}">{{ $i }}</a>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/logs.css') }}">

</html>