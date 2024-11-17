@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h1 class="mt-5">User info</h1>
            <a class="btn btn-secondary" href="{{ route('logout') }}">Logout</a></br></br>
            <button class="add-course-btn btn-primary" id="show-id-card">Add Course</button>
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
        <link rel="stylesheet" type="text/css" href="{{ asset('css/user.css') }}">
        <script src="{{ asset('js/user.js') }}"></script>
    </div>
</div>
@endsection