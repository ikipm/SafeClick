<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\News;
use App\Models\UserCourseProgress;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function courseIndex()
    {
        $courses = Course::all();
        $locale = Session::get('locale', 'cat');
        $news = News::all();
        return view('courses', compact('courses', 'locale', 'news'));
    }

    public function courseInfoContent($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('admin.coursesContent', compact('course'));
    }

    public function courseInfoAddContent($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('admin.coursesAddContent', compact('course'));
    }

    public function storeContent(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title-cat' => 'required|string|max:255',
            'title-es' => 'required|string|max:255',
            'title-en' => 'required|string|max:255',
            'content-cat' => 'required|string',
            'content-es' => 'required|string',
            'content-en' => 'required|string',
        ]);

        $course = Course::findOrFail($id);

        $content_id = ($course->contents()->latest()->first()->content_id ?? 0) + 1;

        $course->contents()->createMany([
            [
                'locale' => 'cat',
                'title' => $validatedData['title-cat'],
                'content' => $validatedData['content-cat'],
                'content_id' => $content_id,
            ],
            [
                'locale' => 'es',
                'title' => $validatedData['title-es'],
                'content' => $validatedData['content-es'],
                'content_id' => $content_id,
            ],
            [
                'locale' => 'en',
                'title' => $validatedData['title-en'],
                'content' => $validatedData['content-en'],
                'content_id' => $content_id,
            ],
        ]);

        return redirect()->back()->with('success', 'Content added');
    }


    public function courseInfo($courseId, $contentId)
    {
        // Retrieve the course
        $course = Course::findOrFail($courseId);

        // Check if the user has an existing progress record for this course
        $userProgress = UserCourseProgress::where('user_id', auth()->user()->id)
            ->where('course_id', $courseId)
            ->first();
        if ($contentId <= $course->contents->count() / 3 and !(auth()->user()->testUser)){
            if (!$userProgress) {
                // Create a new progress record if it doesn't exist
                UserCourseProgress::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => $courseId,
                    'last_content_id' => $contentId,
                ]);
            } elseif ($userProgress->last_content_id < $contentId) {
                if ($userProgress->last_content_id == $contentId - 1) {
                    $userProgress->last_content_id = $contentId;
                    $userProgress->save();
                } else {
                    return redirect()->back()->with('error', 'You must complete the previous content first');
                }
            }
        }

        $content = $course->contents()->where('content_id', $contentId);

        return view('courseID', compact('course', 'content', 'userProgress'));
    }

    public function search(Request $request)
    {
        $query = Course::query();

        // Check if any search parameters are provided
        if ($request->input('course-name') != null) {
            $courseName = $request->input('course-name');
            // Use whereHas to filter courses based on translations
            $query->whereHas('translations', function ($query) use ($courseName) {
                $query->where('title', 'like', "%$courseName%");
            });
        }

        if ($request->input('id') != null) {
            $query->where('id', $request->input('id'));
        }

        $courses = $query->get();

        return redirect('/admin/courses')->with('courses', $courses);
    }

    public function courseEditInfo($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('admin.coursesEdit', compact('course'));
    }

    public function updateCourseTitle(Request $request, $id)
    {
        // Find the course by its ID
        $course = Course::findOrFail($id);

        // Validate the updated data (similar to the create method)
        $validatedData = $request->validate([
            'course-nameCat' => 'required|string|max:255',
            'course-nameEs' => 'required|string|max:255',
            'course-nameEn' => 'required|string|max:255',
            'course-descriptionCat' => 'required|string',
            'course-descriptionEs' => 'required|string',
            'course-descriptionEn' => 'required|string',
            'course-image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Update the course's translations
        $course->translations()->where('locale', 'cat')->update([
            'title' => $validatedData['course-nameCat'],
            'description' => $validatedData['course-descriptionCat'],
        ]);

        $course->translations()->where('locale', 'es')->update([
            'title' => $validatedData['course-nameEs'],
            'description' => $validatedData['course-descriptionEs'],
        ]);

        $course->translations()->where('locale', 'en')->update([
            'title' => $validatedData['course-nameEn'],
            'description' => $validatedData['course-descriptionEn'],
        ]);

        // Handle image upload if provided
        if ($request->hasFile('course-image')) {
            File::delete($course->img);
            $image = $request->file('course-image');
            $imageName = $course->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/img/courses'), $imageName);

            // Update the course's image field with the new image name
            $course->img = '/img/courses/' . $imageName;
        }

        // Save the course
        $course->save();

        return redirect()->back()->with('success', 'Course updated successfully');
    }

    public function courseEditContent($courseId, $contentId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        $content = $course->contents()->where('content_id', $contentId)->get();
        return view('admin.coursesEditContent', compact('course', 'content'));
    }
    
    public function updateContent(Request $request, $id, $contentId)
    {
        // Find the course by its ID
        $course = Course::findOrFail($id);

        // Validate the updated data (similar to the create method)
        $validatedData = $request->validate([
            'title-cat' => 'required|string|max:255',
            'title-es' => 'required|string|max:255',
            'title-en' => 'required|string|max:255',
            'content-cat' => 'required|string',
            'content-es' => 'required|string',
            'content-en' => 'required|string',
        ]);

        // Update the course's translations
        $course->contents()->where('locale', 'cat')->where('content_id', $contentId)->update([
            'title' => $validatedData['title-cat'],
            'content' => $validatedData['content-cat'],
        ]);

        $course->contents()->where('locale', 'es')->where('content_id', $contentId)->update([
            'title' => $validatedData['title-es'],
            'content' => $validatedData['content-es'],
        ]);

        $course->contents()->where('locale', 'en')->where('content_id', $contentId)->update([
            'title' => $validatedData['title-en'],
            'content' => $validatedData['content-en'],
        ]);

        return redirect()->back()->with('success', 'Content updated successfully');
    }
}
