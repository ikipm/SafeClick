@extends('layouts.app')

@section('websiteTitle', 'User Info')

@section('content')
<script src="{{ asset('js/user.js') }}"></script>
<link href="{{ asset('css/user.css') }}" rel="stylesheet">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h1>User Info: {{ Auth::user()->userName }}</h1>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                <button class="btn btn-success" id="show-button">Add Course</button>
            </div>

            @if ($errors->any())
            <div class="alert alert-warning mt-4">
                <ul>
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success mt-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="overlay" id="overlay" style="display: none;">
                <div class="card-wrapper">
                    <div class="card border-success mb-3" id="id-card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            Join a New Course
                            <button type="button" class="btn-close" aria-label="Close" id="close-button"></button>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Insert a Course Key</h5>
                            <form action="{{ route('joinCourse') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="course-key">Course Key</label>
                                    <input type="text" id="course-key" name="course-key" class="form-control" maxlength="10" required>
                                </div>
                                <button type="submit" class="btn btn-outline-success mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
