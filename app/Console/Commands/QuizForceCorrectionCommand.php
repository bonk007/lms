<?php

namespace App\Console\Commands;

use App\Models\QuizAttempt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class QuizForceCorrectionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quiz:force-correction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::transaction(static function () {

            QuizAttempt::query()
                ->whereNull('ended_at')
                ->each(function (QuizAttempt $attempt) {
                    $attempt->doCorrection();
                });
        });
    }
}
