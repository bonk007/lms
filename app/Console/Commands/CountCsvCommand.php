<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\LazyCollection;

class CountCsvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Total : " . $this->collection()->count() - 1);
    }

    protected function collection(): LazyCollection
    {
        return LazyCollection::make(static function () {
            $resource = fopen(storage_path('app/eyetracker-20241217_014240.csv'), 'rb');
            while(($line = fgetcsv($resource)) !== false) {
                yield $line;
            }
        });
    }
}
