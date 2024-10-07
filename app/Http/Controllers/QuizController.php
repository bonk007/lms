<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;

class QuizController extends Controller
{
    public function attempt(QuizAttempt $attempt)
    {
        $attempt->loadMissing(['snapshot']);
        $quizData = $attempt->snapshot->getAttribute('quiz_data');

        return view('components.pages.quizzes.attempt', compact('attempt', 'quizData'));
    }
}
