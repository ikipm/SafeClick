<!DOCTYPE html>
<html>

<head>
    <title>@lang('shared.title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/shared.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <header>
        <x-navbar />
    </header>

    <main>
        @php
            use App\Models\User;
        @endphp

        <div class="container">
            <h2>@lang('admin.welcome') {{ Auth::user()->userName }}</h2>
            <div class="card-container">
                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.usersTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>{{ User::count() }} @lang('admin.users')</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.takingCourse')</h3>
                    </div>
                    <div class="content-text">
                        <h3>No graph at the moment</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.newUsers')</h3>
                    </div>
                    <div class="content-text">
                        <h3>40 @lang('admin.users')</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.excercisesTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>15 @lang('admin.excercices')</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.questionsTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>20 @lang('admin.questions')</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>@lang('admin.feedbackTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>20 @lang('admin.feedback')</h3>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</body>

</html>
