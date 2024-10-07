<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('components.dashboard.pages.courses.create-topics', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Topic $topic)
    {
        return view('components.dashboard.pages.courses.edit-topics', compact('course', 'topic'));
    }
}
