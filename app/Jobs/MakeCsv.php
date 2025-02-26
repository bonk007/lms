<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MakeCsv implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $handler = fopen('php://temp', 'wb');
        fputcsv($handler, [
            'user_id',
            'url',
            'x',
            'y',
            'timespan (ms)',
            'timestamp'
        ]);

        DB::table('gazer_records')
            ->where('user_id', $this->user)
            ->orderBy('created_at')
            ->each(function (\stdClass $object) use ($handler) {
                $record = (array) $object;
                $data = json_decode($record['data'], true, 512, JSON_THROW_ON_ERROR);
                foreach ($data as $datum) {
                    fputcsv($handler, [
                        $record['user_id'],
                        $record['url'],
                        $datum['x'],
                        $datum['y'],
                        $datum['value'],
                        $record['created_at'],
                    ]);
                }
            });

        rewind($handler);

        $content = stream_get_contents($handler);
        fclose($handler);

        $this->toS3($content);
    }

    private function toS3(string $content): void
    {
        Storage::disk('cloudflare-s3')
            ->put('/gazer-records/user-' . $this->user . '-' . now()->format('Ymd_his') . '.csv', $content);
    }
}
