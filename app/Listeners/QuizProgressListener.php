<?php

namespace App\Listeners;

use App\DTO\AnswerData;
use App\Events\QuizProgressUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QuizProgressListener
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
    public function handle(QuizProgressUpdated $event): void
    {
        $attempt = $event->attempt();
        /** @var array $latestProgress */
        $latestProgress = collect($attempt->progress)->last();

    }
}
