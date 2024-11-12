<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function __invoke(Course $course, Assignment $assignment)
    {
        return view('components.dashboard.pages.courses.assignments', compact('course', 'assignment'));
    }
}
