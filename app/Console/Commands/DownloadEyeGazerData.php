<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DownloadEyeGazerData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'download';

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
        $path = '/gazer-records';

        $files = Storage::disk('cloudflare-s3')
            ->files($path);

//        foreach ($files as $filepath) {
////            $this->info($filepath);
//            $streamed = Storage::disk('cloudflare-s3')->get($filepath);
//
//            Storage::disk('local')->put($filepath, $streamed);
//        }

        $this->info(count($files));

    }
}
