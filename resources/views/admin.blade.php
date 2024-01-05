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
            use App\Models\User;
            use App\Models\Course;
            use Illuminate\Support\Facades\DB;
        @endphp

        <div class="container">
            <h2>@lang('admin.welcome') {{ Auth::user()->userName }}</h2>
            <div class="card-container">
                <a href="/admin/users" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.usersTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>{{ User::count() }} @lang('admin.users')</h3>
                    </div>
                </a>

                <a href="/admin/courses" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.courseTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>{{ Course::count() }} @lang('admin.course')</h3>
                    </div>
                </a>

                <a href="/admin" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.newUsers')</h3>
                    </div>
                    <div class="content-text">
                        <h3>{{DB::table('users')->whereBetween('created_at', [now()->startOfWeek()->toDateString() . ' 00:00:00', now()->endOfWeek()->toDateString() . ' 23:59:59'])->count();}} @lang('admin.users')</h3>
                    </div>
                </a>

                <a href="/admin" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.excercisesTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>15 @lang('admin.excercices')</h3>
                    </div>
                </a>

                <a href="/admin" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.questionsTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>20 @lang('admin.questions')</h3>
                    </div>
                </a>

                <a href="/admin" class="card">
                    <div class="card-header">
                        <h3>@lang('admin.feedbackTitle')</h3>
                    </div>
                    <div class="content-text">
                        <h3>20 @lang('admin.feedback')</h3>
                    </div>
                </a>
            </div>
        </div>

    </main>
    <script src="{{ asset('js/sideBar.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
</body>

</html>
