<?php

namespace App\Providers;

use App\Models\{Agenda, Assignment, Attachment, Conversation, Course, Discussion, Enrollment, EnrollmentInvitation, Instance, Message, Permission, Post, Question, Quiz, QuizAttempt, QuizSection, Resource, Role, Section, Sessions\CourseSession, Sessions\TopicSession, Snapshots\QuizSnapshot, Topic, User};
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->defineMorphMap();
    }

    /**
     * Defines polymorphic names of the models
     * @return void
     */
    protected function defineMorphMap(): void
    {
        Relation::morphMap([
            'agendas' => Agenda::class,
            'assignments' => Assignment::class,
            'attachments' => Attachment::class,
            'conversations' => Conversation::class,
            'courses' => Course::class,
            'course_sessions' => CourseSession::class,
            'discussions' => Discussion::class,
            'enrollments' => Enrollment::class,
            'enrollment_invitations' => EnrollmentInvitation::class,
            'instances' => Instance::class,
            'messages' => Message::class,
            'permissions' => Permission::class,
            'posts' => Post::class,
            'questions' => Question::class,
            'quizzes' => Quiz::class,
            'quiz_attempts' => QuizAttempt::class,
            'quiz_sections' => QuizSection::class,
            'quiz_snapshots' => QuizSnapshot::class,
            'resources' => Resource::class,
            'roles' => Role::class,
            'sections' => Section::class,
            'topics' => Topic::class,
            'topic_sessions' => TopicSession::class,
            'users' => User::class,
        ]);
    }
}
