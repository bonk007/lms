<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Course $course, Topic $topic)
    {
        return view('components.pages.courses.topics.show', compact('course', 'topic'));
    }
}
