<?php

namespace App\Services\Cloudflare\Jobs;

use App\Services\Cloudflare\Stream;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class StreamUpload implements ShouldQueue
{
    use Dispatchable,
        InteractsWithQueue,
        Queueable,
        SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $encryptedPayload, public string $url)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new Stream())->upload($this->encryptedPayload, $this->url, function (Collection $response) {
            $decryptedPayload = decrypt($this->encryptedPayload);
            $modelClass = $decryptedPayload['resource_model'];

            if (empty($modelClass) || !class_exists($modelClass)) {
                return;
            }

            $resource = $modelClass::find($decryptedPayload['resource_id']);
            $uid = $response->get('uid');

            Log::debug("what is this", compact('response', 'uid', 'resource'));

            if (null === $uid || null === $resource) {
                return;
            }

            $resource->update([
                'content_url' => $uid
            ]);

        });
    }
}
