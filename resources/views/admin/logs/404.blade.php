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
            $logEntries = array_reverse(file(storage_path('logs/404.log')));
            $perPage = 15;
            $currentPage = request('page', 1);
            $offset = ($currentPage - 1) * $perPage;
            $entriesToShow = array_slice($logEntries, $offset, $perPage);
            $totalPages = ceil(count($logEntries) / $perPage);
        @endphp
        <div class="container">
            <h2>Admin log system</h2>
            <div class="card">
                <div class="card-header">
                    <h3>@lang('admin.404') | Page: {{$currentPage}}/{{$totalPages}}</h3>
                </div>
                <div class="content-text">
                    @foreach($entriesToShow as $line)
                    <p>{{$line}}</p>
                    @endforeach

                    @if ($totalPages > 1)
                    <div class="pagination">
                        @if ($currentPage > 1)
                        <a href="?page={{ $currentPage - 1 }}">Previous</a>
                        @endif
                        @if ($currentPage < $totalPages) <a href="?page={{ $currentPage + 1 }}">Next</a>
                            @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/logs.css') }}">

</html>
