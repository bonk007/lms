<?php

namespace App\Services\Cloudflare;

use App\Models\Resource;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Stream
{
    public function __construct()
    {
    }

    public function upload(string $encryptedPayload, string $url, ?callable $callback = null): void
    {
        $resource = Storage::disk('cloudflare-s3')->readStream($url);
        $payload = decrypt($encryptedPayload);

        $response = Http::withToken(config('cloudflare.token'))
            ->attach(name: 'file', contents: $resource, filename: $payload['filename'])
            ->post($this->getUrl());

        $result = $response
            ->onError(function (Response $response) {
                Log::error("Something wrong", ['reason' => $response]);
                throw new StreamUploaderException();
            })
            ->collect('result');

        if ($callback !== null) {
            $callback($result);
        }
    }

    private function getUrl(): string
    {
        return config('cloudflare.base_url')
            . '/' . config('cloudflare.api_version')
            . '/accounts/' . config('cloudflare.account_id')
            . '/stream';
    }

}
