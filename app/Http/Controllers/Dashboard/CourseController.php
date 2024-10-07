<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('components.dashboard.pages.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.dashboard.pages.courses.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('components.dashboard.pages.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }
}
