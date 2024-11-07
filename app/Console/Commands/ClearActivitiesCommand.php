<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClearActivitiesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear-activities';

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
        $this->backupOldActivities()
            ->deleteOldActivities();
    }

    /**
     * Put the records into csv, then save to S3 storage
     * @return $this
     */
    protected function backupOldActivities(): self
    {
        $this->info("Creating backup");
        $handler = fopen('php://temp', 'wb');
        $filename = now()->format('Y-m-d_H-i-s').'.csv';

        $this->oldActivitiesQuery()->each(function ($object) use ($handler) {
            $data = (array) $object;
            fputcsv($handler, array_values($data));
        });

        Storage::disk('s3')->put('activities/'.$filename, $handler);

        $this->info("Backup file was stored as '".$filename."'");

        return $this;
    }

    protected function deleteOldActivities(): void
    {
        $this->info("Deleting 1-month old activities");
        DB::transaction(function () {
            // delete 1-month-old of activities
            $this->oldActivitiesQuery()->delete();
        });
        $this->info("1-month old activities were deleted");
    }

    protected function oldActivitiesQuery(): Builder
    {
        return DB::table('activities')
            ->where('created_at', '<', now()->subDays(30));
    }
}
