<?php

namespace App\Console\Commands;

use App\Models\EnrollmentInvitation;
use Illuminate\Console\Command;

class FlushInvitationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitation:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up invitation table';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        EnrollmentInvitation::flush();
    }
}
