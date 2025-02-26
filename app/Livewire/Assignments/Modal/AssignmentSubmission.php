<?php

namespace App\Livewire\Assignments\Modal;

use App\Livewire\Assignments\Detail;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\Attachment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class AssignmentSubmission extends ModalComponent
{
    use WithFileUploads;

    /** @var \Livewire\Features\SupportFileUploads\TemporaryUploadedFile */
    public $upload;

    public string $response = '';

    public Assignment $assignment;

    public function attempt(): void
    {
        $this->validate([
            'upload' => ['nullable', 'file', 'max:1024'],
            'response' => ['required_unless:upload,null'],
        ]);

        $attempt = DB::transaction(function () {
            $attempt = $this->assignment->attempts()
                ->create([
                    'user_id' => auth()->id(),
                    'response' => $this->upload ? null : $this->response
                ]);

            $this->attachFile($attempt);

            return $attempt;
        });

        $this->closeModal();
        $this->dispatch('attempted', $attempt)->to(Detail::class);
    }

    protected function attachFile(AssignmentAttempt $attempt): void
    {
        if (null === $this->upload) {
            return;
        }

        $filename = auth()->id() .'-'. Str::slug(auth()->user()->name) .'.' . $this->upload->getClientOriginalExtension();
        $path = 'assignments/'.$this->assignment->id.'/attempts';
        $mime = $this->upload->getMimeType();
        $size = $this->upload->getSize();

        if (!$this->upload->storeAs($path, $filename, 'cloudflare-s3')) {
            return;
        }

        $attachment = Attachment::create([
            'user_id' => auth()->id(),
            'path' => $path . '/' . $filename,
            'mime' => $mime,
            'size' => $size,
        ]);

        $attempt->attachments()->attach($attachment->id);
    }

    public function render(): View
    {
        return view('livewire.assignments.modal.assignment-submission');
    }
}
