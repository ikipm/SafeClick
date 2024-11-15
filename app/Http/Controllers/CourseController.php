<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\News;
use App\Models\User;
use App\Models\UserCourseProgress;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Safe the course information at a first time.
     * @Pre: The request $request is received as a parameter.
     * @Post: The courses information is stored in the database.
     */
    public function store(Request $request)
    {
        $public = $request->public ? true : false;
        $validatedData = $request->validate([
            'course-nameCat' => 'required|string|max:255',
            'course-nameEs' => 'required|string|max:255',
            'course-nameEn' => 'required|string|max:255',
            'course-descriptionCat' => 'required|string',
            'course-descriptionEs' => 'required|string',
            'course-descriptionEn' => 'required|string',
            'course-image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->input('allowed-users')){
            $usernames = explode(", ", $request->input('allowed-users'));
            $existingUsers = User::whereIn('username', $usernames)->pluck('username')->toArray();
            $nonExistingUsers = array_diff($usernames, $existingUsers);

            if (!empty($nonExistingUsers)) {
                return redirect()->back()->withErrors(['allowed-users' => 'The following users do not exist: ' . implode(', ', $nonExistingUsers)]);
            }

            $userIds = User::whereIn('username', $usernames)->pluck('id')->toArray();
        } else {
            $userIds = [];
        }

        do {
            $course_key = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
        } while (Course::where('key', $course_key)->exists());

        $course = Course::create([
            'public' => $public,
            'allowed_users' => json_encode($userIds),
            'key' => $course_key,
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

    /**
     * Display the courses page.
     * @Pre: No parameters expected.
     * @Post: The courses page is displayed.
     */
    public function courseIndex()
    {
        $courses = Course::where('public', true)
            ->orWhereJsonContains('allowed_users', auth()->user()->id)
            ->get();
        $locale = Session::get('locale', 'cat');
        $news = News::all();
        return view('courses', compact('courses', 'locale', 'news'));
    }

    /**
     * Display a course information.
     * @Pre: The course ID $courseId is received as a parameter.
     * @Post: The courses information is displayed.
     */
    public function courseInfoContent($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('admin.coursesContent', compact('course'));
    }

    /**
     * Display information at the add view.
     * @Pre: The course ID $courseId is received as a parameter.
     * @Post: The courses information is displayed at the add view.
     */
    public function courseInfoAddContent($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        return view('admin.coursesAddContent', compact('course'));
    }

    /**
     * Modify the course content information.
     * @Pre: The request $request and the course ID $id are received as parameters.
     * @Post: The courses content information is stored in the database.
     */
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

    /**
     * Display course theory.
     * @Pre: The course ID $courseId and the content ID $contentId are received as parameters.
     * @Post: The courses theory are displayed and the user progress updated.
     */
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

    /**
     * Search for a course.
     * @Pre: The request $request is received as a parameter.
     * @Post: List the courses that match the search criteria are displayed.
     */
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

    /**
     * Display the course edit view.
     * @Pre: The course ID $courseId is received as a parameter.
     * @Post: The course edit view is displayed with the course information.
     */
    public function courseEditInfo($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        $userIds = json_decode($course->allowed_users, true);
        $usernames = User::whereIn('id', $userIds)->pluck('username')->toArray();
        $usernamesString = implode(', ', $usernames);
        return view('admin.coursesEdit', compact('course', 'usernamesString'));
    }

    /**
     * Update the course information.
     * @Pre: The request $request and the course ID $id are received as parameters.
     * @Post: The courses information is updated in the database.
     */
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
            'allowed-users' => 'required|string',
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

        $public = $request->public ? true : false;
        $course->public = $public;

        $usernames = explode(", ", $request->input('allowed-users'));
        $existingUsers = User::whereIn('username', $usernames)->pluck('username')->toArray();
        $nonExistingUsers = array_diff($usernames, $existingUsers);

        if (!empty($nonExistingUsers)) {
            return redirect()->back()->withErrors(['allowed-users' => 'The following users do not exist: ' . implode(', ', $nonExistingUsers)]);
        }

        $userIds = User::whereIn('username', $usernames)->pluck('id')->toArray();
        $course->allowed_users = json_encode($userIds);

        // Save the course
        $course->save();

        return redirect()->back()->with('success', 'Course updated successfully');
    }

    /**
     * Display the course edit view for a course content
     * @Pre: The course ID $courseId and the content ID $contentId are received as parameters.
     * @Post: The course edit view for a course content is displayed with the content information.
     */
    public function courseEditContent($courseId, $contentId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        $content = $course->contents()->where('content_id', $contentId)->get();
        return view('admin.coursesEditContent', compact('course', 'content'));
    }
    
    /**
     * Update the course content information.
     * @Pre: The request $request, the course ID $id and the content ID $contentId are received as parameters.
     * @Post: The courses content information is updated in the database.
     */
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

    /**
     * Join a course.
     * @Pre: The request $request is received as a parameter.
     * @Post: The user is added to the course.
     */
    public function joinCourse(Request $request)
    {
        $course = Course::where('key', $request->input('course-key'))->first();

        if (!$course) {
            return redirect()->back()->withErrors(['course-key' => 'Invalid course key']);
        }

        $allowedUsers = json_decode($course->allowed_users, true);
        $allowedUsers[] = auth()->user()->id;
        $course->allowed_users = json_encode($allowedUsers);
        $course->save();

        return redirect()->back()->with('success', 'Course joined successfully');
    }
}
