<?php

namespace App\Listeners;

use App\Events\CourseCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyCourseContributor
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CourseCompleted $event): void
    {
        /** @var \App\Models\User $creator */
        $creator = $event->session->loadMissing(['course.creator'])->getAttribute('course')->getAttribute('creator');

        $creator->notify();
    }
}
