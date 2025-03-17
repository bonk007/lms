<?php

namespace App\Livewire\Dashboard\Traits;

use App\Models\Slide;
use App\Services\Cloudflare\VideoUploader;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait HasMultipleContent
{
    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile */
    public $file;

    public function getValidatedData(array $additionalRules = [], bool $updated = false): array
    {
        return Arr::except([
            ... $this->validate([
                ...$additionalRules,
                ...[
                    'isHTML' => ['bool'],
                    'content' => ['required_if:isHTML,true'],
                    'file' => !$updated
                        ? ['required_if:isHTML,false', 'nullable', 'file', 'mimes:pdf,doc,docx,mp4,avi,mov,webm']
                        : ['nullable', 'file', 'mimes:pdf,doc,docx,mp4,avi,mov,webm'],
                ],
            ]),
            ...[
                'content_mime' => $this->contentMime(),
                'downloadable' => $this->isDownloadable(),
                'streaming' => !$this->isDownloadable(),
//                'content_url' => $this->uploadFile(),
                'html_content' => $this->content
            ]
        ], ['isHTML', 'upload', 'content']);
    }

    public function uploadFile(string $modelClass): ?string
    {
        if (!$this->file instanceof TemporaryUploadedFile) {
            return null;
        }

        $path = 'resources' . DIRECTORY_SEPARATOR . auth()->id();
        $name = Str::random(8) . '.' . $this->file->extension();

        if ($this->resource !== null && !$this->isDownloadable() && $this->streamable()) {
            return (new VideoUploader($this->resource))->upload($modelClass, $this->file, auth()->user());
        }

        return $this->file->storeAs($path, $name);
    }

    public function createSlide(): Slide
    {
        $slide = new Slide();

        $slide->user()->associate(auth()->user())->save();

        $this->resource->slides()->attach($slide->id);

        return $slide;
    }

    protected function streamable(): bool
    {
        return in_array($this->file->extension(), ['mp4', 'avi', 'mov', 'webm']);
    }

    protected function isDownloadable(): bool
    {
        if (!$this->file instanceof TemporaryUploadedFile) {
            return false;
        }

        return !$this->streamable() && !in_array($this->file->extension(), ['pdf', 'ppt', 'pptx']);
    }

    protected function contentMime(): string
    {
        if (!$this->file instanceof TemporaryUploadedFile) {
            return 'text/html';
        }

        return $this->file->getMimeType();
    }
}
