<?php

namespace App\Livewire\Dashboard\Resources;

use App\Livewire\Dashboard\Traits\HasMultipleContent;
use App\Livewire\Traits\HasAlert;
use App\Models\Resource;
use App\Services\Cloudflare\VideoUploader;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads, HasAlert, HasMultipleContent;

    public bool $isHTML = true;

    public string $pageTitle = '';

    public string $title = '';

    public string $abstract = '';

    public ?string $content = null;


    public ?Resource $resource = null;

    protected $listeners = [
        'saved' => 'saved'
    ];

    public function mount(): void
    {
        $this->title = $this->resource?->getAttribute('title') ?? '';
        $this->abstract = $this->resource?->getAttribute('abstract') ?? '';
        $this->content = $this->resource?->getAttribute('html_content');
        $this->isHTML = 'text/html' === $this->resource?->getAttribute('content_mime');
    }

    public function submit(): void
    {
        $data = $this->getValidatedData([
            'title' => ['required', 'max:255'],
            'abstract' => ['required'],
        ]);

        DB::transaction(function () use ($data) {
            if ($this->resource instanceof Resource) {
                $this->update($data);
            } else {
                $this->create($data);
            }
            $this->uploadFile(get_class($this->resource));
        });

        $this->dispatch('saved');
    }

    public function render(): View
    {
        return view('livewire.dashboard.resources.form');
    }

    public function saved(): void
    {
        $this->redirectRoute('management.resources.index');
    }

    protected function create(array $data): void
    {
        $resource = new Resource($data);
        $resource->creator()->associate(auth()->user())->save();

        $this->resource = $resource;

        $this->success(__("New resource has been created"));
    }

    protected function update(array $data): void
    {
        $this->resource->update($data);
        $this->success(__("Resource has been updated"));
    }
}
