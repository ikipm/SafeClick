<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img' => 'required',
            'url' => 'nullable',
            'title-cat' => 'required|string',
            'title-es' => 'required|string',
            'title-en' => 'required|string',
            'description-cat' => 'required|string',
            'description-es' => 'required|string',
            'description-en' => 'required|string',
            'content-cat' => 'required|string',
            'content-es' => 'required|string',
            'content-en' => 'required|string',
        ]);

        $news = News::create([
            'img' => $validatedData['img'],
            'url' => $validatedData['url'],
        ]);

        $news->translations()->createMany([
            ['locale' => 'cat', 'title' => $validatedData['title-cat'], 'description' => $validatedData['description-cat'], 'content' => $validatedData['content-cat']],
            ['locale' => 'en', 'title' => $validatedData['title-en'], 'description' => $validatedData['description-en'], 'content' => $validatedData['content-en']],
            ['locale' => 'es', 'title' => $validatedData['title-es'], 'description' => $validatedData['description-es'], 'content' => $validatedData['content-es']],
        ]);

        if ($request->has('img')) {
            $image = $request->file('img');
            $imageName = $news->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/news'), $imageName);

            $news->img = 'img/news/' . $imageName;
            $news->save();
        }

        return redirect()->back()->with('success', 'News created successfully!');
    }

    public function newsIndex()
    {
        $news = News::all();
        return view('news', ['news' => $news]);
    }
}
