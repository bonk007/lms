<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Console\Command;

class CreateTestNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:test';

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
        $user = User::find(1);

        $user->notify(new TestNotification());

    }
}
