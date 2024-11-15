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
        <div class="user-container">
            <div style="padding: 30px;">
                <h1 style="margin-top: 90px;">User info</h1>
                <a class="button" href="{{ route('logout') }}">Logout</a></br></br>
                <button class="add-course-btn button" id="show-id-card">Add Course</button>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="id-card-overlay" id="id-card-overlay">
                    <div class="id-card">
                        <button class="close-btn" id="close-id-card">&times;</button>
                        <div class="id-card-header">
                            <h3>Join a New Course</h3>
                        </div>
                        <div class="id-card-body">
                            <form action="{{ route('joinCourse') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="course-key">Course key</label>
                                    <input type="text" id="course-key" name="course-key" class="form-control" maxlength="10" required>
                                </div>
                                <button type="submit" class="btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
<script src="{{ asset('js/user.js') }}"></script>

</html>