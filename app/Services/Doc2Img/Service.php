<?php

namespace App\Services\Doc2Img;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Service
{
    public function __construct(public UploadedFile|TemporaryUploadedFile $file)
    {
    }

    public function upload(string $identifier)
    {
        Http::asForm();
    }
}
