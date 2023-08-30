<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'course-name' => 'required|string|max:255',
            'course-description' => 'required|string',
        ]);

        $course = Course::create([
            'title' => $data['course-name'],
            'description' => $data['course-description'],
            'status' => true,
        ]);

        return redirect()->back()->with('success', 'Course created successfully');
    }

    public function courseInfo($courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('courseID', compact('course'));
    }
}
