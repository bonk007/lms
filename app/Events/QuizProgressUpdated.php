<?php

namespace App\Events;

use App\Models\QuizAttempt;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuizProgressUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(protected QuizAttempt $attempt)
    {
        //
    }

    public function attempt(): QuizAttempt
    {
        return $this->attempt;
    }
}
