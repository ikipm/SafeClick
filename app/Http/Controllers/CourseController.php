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
     * Store the course information for the first time.
     * @Pre: The request $request is received as a parameter.
     * @Post: The courses information is stored in the database.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateCourse($request);

        $userIds = $this->getUserIds($request->input('allowed-users'));

        if (!is_array($userIds)) {
            return redirect()->back()->withErrors(['allowed-users' => 'Some users do not exist.']);
        }

        $course_key = $this->generateUniqueCourseKey();

        $course = Course::create([
            'public' => $request->boolean('public'),
            'allowed_users' => json_encode($userIds),
            'key' => $course_key,
        ]);

        $this->createCourseTranslations($course, $validatedData);

        $this->handleImageUpload($request, $course);

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
        $validatedData = $this->validateContent($request);

        $course = Course::findOrFail($id);

        $content_id = ($course->contents()->latest()->first()->content_id ?? 0) + 1;

        $this->createCourseContents($course, $validatedData, $content_id);

        return redirect()->back()->with('success', 'Content added');
    }

    /**
     * Display course theory.
     * @Pre: The course ID $courseId and the content ID $contentId are received as parameters.
     * @Post: The courses theory are displayed and the user progress updated.
     */
    public function courseInfo($courseId, $contentId)
    {
        $course = Course::findOrFail($courseId);

        $userProgress = $this->updateUserProgress($course, $courseId, $contentId);

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

        if ($courseName = $request->input('course-name')) {
            $query->whereHas('translations', function ($query) use ($courseName) {
                $query->where('title', 'like', "%$courseName%");
            });
        }

        if ($id = $request->input('id')) {
            $query->where('id', $id);
        }

        $courses = $query->get();

        return redirect('/admin/courses')->with(['courses' => $courses]);
    }

    /**
     * Display the course edit view.
     * @Pre: The course ID $courseId is received as a parameter.
     * @Post: The course edit view is displayed with the course information.
     */
    public function courseEditInfo($courseId)
    {
        $course = Course::with('translations')->findOrFail($courseId);
        $usernamesString = $this->getUsernamesString($course->allowed_users);
        return view('admin.coursesEdit', compact('course', 'usernamesString'));
    }

    /**
     * Update the course information.
     * @Pre: The request $request and the course ID $id are received as parameters.
     * @Post: The courses information is updated in the database.
     */
    public function updateCourseTitle(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validatedData = $this->validateCourse($request);

        $this->updateCourseTranslations($course, $validatedData);

        $this->handleImageUpload($request, $course);

        $userIds = $this->getUserIds($request->input('allowed-users'));

        if ($userIds === false) {
            return redirect()->back()->withErrors(['allowed-users' => 'Some users do not exist.']);
        }

        $course->update([
            'public' => $request->boolean('public'),
            'allowed_users' => json_encode($userIds),
        ]);

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
        $course = Course::findOrFail($id);

        $validatedData = $this->validateContent($request);

        $this->updateCourseContents($course, $validatedData, $contentId);

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

    /**
     * Validate the course information received.
     * @Pre: The request $request is received as a parameter with all the information insered.
     * @Post: The course information is validated and errors are returned.
     */

    private function validateCourse(Request $request)
    {
        return $request->validate([
            'course-nameCat' => 'required|string|max:255',
            'course-nameEs' => 'required|string|max:255',
            'course-nameEn' => 'required|string|max:255',
            'course-descriptionCat' => 'required|string',
            'course-descriptionEs' => 'required|string',
            'course-descriptionEn' => 'required|string',
            'course-image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'allowed-users' => 'nullable|string',
        ]);
    }
    
    /**
     * Validate the content information received.
     * @Pre: The request $request is received as a parameter with all the information insered.
     * @Post: The content information is validated and errors are returned.
     */
    private function validateContent(Request $request)
    {
        return $request->validate([
            'title-cat' => 'required|string|max:255',
            'title-es' => 'required|string|max:255',
            'title-en' => 'required|string|max:255',
            'content-cat' => 'required|string',
            'content-es' => 'required|string',
            'content-en' => 'required|string',
        ]);
    }

    /**
     * Get the user IDs from the usernames.
     * @Pre: The usernames $usernames are received in an array as a parameter.
     * @Post: An array of user ID's is returned.
     */
    private function getUserIds($usernames)
    {
        if (!$usernames) {
            return [];
        }

        $usernamesArray = explode(", ", $usernames);
        $users = User::whereIn('username', $usernamesArray)->pluck('id', 'username')->toArray();
        $nonExistingUsers = array_diff($usernamesArray, array_keys($users));

        if (!empty($nonExistingUsers)) {
            return false;
        }

        return array_values($users);
    }

    /**
     * Get the usernames from the user IDs.
     * @Pre: The allowed users $allowed_users are received in an array as a parameter.
     * @Post: A string containing the usernames splited with comas is returned.
     */
    private function getUsernamesString($allowed_users)
    {
        $userIds = json_decode($allowed_users, true);
        $usernames = User::whereIn('id', $userIds)->pluck('username')->toArray();
        return implode(', ', $usernames);
    }

    /**
     * Generate a unique course key.
     * @Pre: No parameters expected.
     * @Post: A unique course key is returned combining numbers, uppercase and lowercase.
     */
    private function generateUniqueCourseKey()
    {
        do {
            $course_key = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10);
        } while (Course::where('key', $course_key)->exists());

        return $course_key;
    }

    /**
     * Create the course translations.
     * @Pre: The course $course and the validated data $validatedData are received as parameters.
     * @Post: The course translations are created in the database linked with the $course.
     */
    private function createCourseTranslations($course, $validatedData)
    {
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
    }

    /**
     * Handle the image upload and storage.
     * @Pre: The request $request and the course $course are received as parameters.
     * @Post: The image is uploaded to the server and the course image path is stored in the database.
     */
    private function handleImageUpload(Request $request, $course)
    {
        if ($request->hasFile('course-image')) {
            $image = $request->file('course-image');
            $imageName = $course->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/img/courses'), $imageName);

            $course->img = '/img/courses/' . $imageName;
            $course->save();
        }
    }

    /**
     * Create the course contents.
     * @Pre: The course $course, the validated data $validatedData and the content ID $content_id are received as parameters.
     * @Post: The course contents are created in the database linked with the $course.
     */
    private function createCourseContents($course, $validatedData, $content_id)
    {
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
    }

    /**
     * Update the user progress.
     * @Pre: The course $course, the course ID $courseId and the content ID $contentId are received as parameters.
     * @Post: The user progress is updated in the database.
     */
    private function updateUserProgress($course, $courseId, $contentId)
    {
        $userProgress = UserCourseProgress::firstOrNew([
            'user_id' => auth()->id(),
            'course_id' => $courseId,
        ]);

        if ($contentId <= $course->contents->count() / 3 && !auth()->user()->testUser) {
            if ($userProgress->last_content_id < $contentId) {
                if ($userProgress->last_content_id == $contentId - 1) {
                    $userProgress->last_content_id = $contentId;
                    $userProgress->save();
                } else {
                    return redirect()->back()->with('error', 'You must complete the previous content first');
                }
            }
        }

        return $userProgress;
    }

    /**
     * Update the course translations.
     * @Pre: The course $course and the validated data $validatedData are received as parameters.
     * @Post: The course translations are updated in the database.
     */
    private function updateCourseTranslations($course, $validatedData)
    {
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
    }

    /**
     * Update the course contents.
     * @Pre: The course $course, the validated data $validatedData and the content ID $contentId are received as parameters.
     * @Post: The course contents are updated in the database.
     */
    private function updateCourseContents($course, $validatedData, $contentId)
    {
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
    }
}
