<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('components.dashboard.pages.quizzes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.dashboard.pages.quizzes.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        return view('components.dashboard.pages.quizzes.edit', compact('quiz'));
    }
}
