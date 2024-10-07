<?php

namespace App\Services\Cloudflare;

use App\Models\Instance;
use App\Models\Resource;
use App\Models\User;
use App\Services\Cloudflare\Jobs\StreamUpload;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoUploader
{
    public function __construct(protected Resource $resource)
    {
    }

    /**
     * @throws \Throwable
     */
    public function upload(string $modelClass, UploadedFile $uploadedFile, User $user): string
    {
        $filename = Str::random() . '.' . $uploadedFile->getClientOriginalExtension();
        $payload = [
            'timestamp' => now(),
            'user' => $user->getKey(),
            'resource_id' => $this->resource->getKey(),
            'resource_model' => $modelClass,
            'mime' => $uploadedFile->getClientMimeType(),
            'extension' => $uploadedFile->getClientOriginalExtension(),
            'filename' => $filename
        ];
        $encryptedPayload = encrypt($payload);

        $url = throw_unless(
            $uploadedFile->storePubliclyAs('cf-tmp', $filename, 'cloudflare-s3'),
            StreamUploaderException::class
        );

        dispatch(new StreamUpload($encryptedPayload, $url));

        return 'https://cdn.ibonk.id/' . $url;
    }
}
