<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'course-nameCat' => 'required|string|max:255',
            'course-nameEs' => 'required|string|max:255',
            'course-nameEn' => 'required|string|max:255',
            'course-descriptionCat' => 'required|string',
            'course-descriptionEs' => 'required|string',
            'course-descriptionEn' => 'required|string',
            'course-image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $course = Course::create([
            'status' => true,
        ]);

        $course->translations()->createMany([
            [
                'locale' => 'cat',
                'title' => $validatedData['course-nameCat'],
                'description' => $validatedData['course-descriptionCat'],
            ],
            [
                'locale' => 'es',
                'title' => $validatedData['course-nameEs'],
                'description' => $validatedData['course-descriptionEs'],
            ],
            [
                'locale' => 'en',
                'title' => $validatedData['course-nameEn'],
                'description' => $validatedData['course-descriptionEn'],
            ],
        ]);

        // Handle image upload
        if ($request->hasFile('course-image')) {
            $image = $request->file('course-image');
            $imageName = $course->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/img/courses'), $imageName);

            // Update the course's image field with the image name
            $course->img = '/img/courses/' . $imageName;
            $course->save();
        }

        return redirect()->back()->with('success', 'Course created successfully');
    }

    public function courseInfo($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('courseID', compact('course'));
    }

    public function search(Request $request)
    {
        $query = Course::query();

        // Check if any search parameters are provided
        if ($request->has('course-nameCat')) {
            $query->whereHas('translations', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('course-nameCat') . '%');
            });
        }

        if ($request->has('course-nameEs')) {
            $query->whereHas('translations', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('course-nameEs') . '%');
            });
        }

        if ($request->has('course-nameEn')) {
            $query->whereHas('translations', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('course-nameEn') . '%');
            });
        }

        if ($request->has('id')) {
            $query->where('id', $request->input('id'));
        }

        $courses = $query->get();

        return redirect('/admin/courses')->with('courses', $courses);
    }
}
