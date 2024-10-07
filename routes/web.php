<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'components.pages.home')->name('home');
Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('courses');


Route::middleware('guest')->group(function () {
    Route::view('/login', 'components.pages.login')->name('login');
    Route::view('/register', 'components.pages.register')->name('register');
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user?}', [ProfileController::class, 'view'])->name('profile');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::view('/agenda', 'components.pages.agenda')->name('agenda');
    Route::view('/notifications', 'components.pages.notifications')->name('notifications');
    Route::get('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'show'])->name('courses.show');
    Route::get('/courses/{course}/topics/{topic}', [\App\Http\Controllers\TopicController::class, 'show'])->name('courses.topics.show');
    Route::get('/sections/{section}', [\App\Http\Controllers\SectionController::class, 'show'])->name('section.show');
    Route::get('/quiz-attempt/{attempt}', [\App\Http\Controllers\QuizController::class, 'attempt'])->name('quiz.attempt');

//    Route::view('/sections/{section}', \App\View\Components\Pages\Courses\Section::class)->name('section.show');
    Route::middleware('can:manage')
        ->prefix('management')
        ->name('management.')
        ->group(function () {
            Route::view('/', 'components.dashboard.pages.home')->name('home');
            Route::resource('courses', \App\Http\Controllers\Dashboard\CourseController::class);
            Route::get('courses/{course}/topics/create', [\App\Http\Controllers\Dashboard\TopicController::class, 'create'])->name('topics.create');
            Route::get('courses/{course}/topics/{topic}/edit', [\App\Http\Controllers\Dashboard\TopicController::class, 'edit'])->name('topics.edit');
            Route::resource('resources', \App\Http\Controllers\Dashboard\ResourceController::class);
            Route::resource('quizzes', \App\Http\Controllers\Dashboard\QuizController::class)
                ->only(['index', 'create', 'edit']);
        });

});
