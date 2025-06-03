<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Sessions\CourseSession;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('components.pages.courses.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        $session = CourseSession::query()
            ->whereBelongsTo(auth()->user(), 'user')
            ->whereBelongsTo($course, 'course')
            ->first();
        $schema = $session ? substr($session->getAttribute('aui_schema'), 0, -2) : null;

        $view = match ($schema) {
            'stepper' => 'components.pages.courses.aui.steps',
            default => 'components.pages.courses.show'
        };

        return view($view, compact('course'));
    }
}
