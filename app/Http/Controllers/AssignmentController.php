<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;

final class AssignmentController extends Controller
{
    public function __invoke(Request $request, Course $course, Assignment $assignment)
    {
        return view('components.pages.courses.assignment', compact('course', 'assignment'));
    }
}
