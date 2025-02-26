<?php

namespace App\Livewire\Dashboard\Assignment;

use App\Models\Agenda;
use App\Models\Assignment;
use App\Models\Attachment;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use WithFileUploads;

    public $upload;

    public Course $course;

    public ?Assignment $assignment = null;

    public string $title = '';

    public string $description = '';

    public ?int $durationUnit = null;

    public ?int $duration = null;

    public string $startedDate = '';

    public string $startedTime = '';

    public array $minDateTime = [];

    public function mount()
    {
        $this->course->loadMissing([
            'enrollments.user'
        ]);
    }

    public function boot(): void
    {
        $this->title = $this->assignment?->title ?? '';
        $this->description = $this->assignment?->description ?? '';
        $this->duration = $this->assignment?->duration;
        $this->durationUnit = $this->convertDurationUnit($this->assignment?->getAttribute('duration_unit'));

        $now = now()->timezone(config('app.timezone'))->addHour();

        $this->minDateTime = [
            $now->format('Y-m-d'),
            $now->format('H:i:s'),
        ];

        $startedAt = $this->assignment?->getAttribute('started_at') ?? $now;

        $this->startedDate = $startedAt->format('Y-m-d');
        $this->startedTime = $startedAt->format('H:i:s');

    }

    protected function chooseDurationUnit(?int $index): ?string
    {
        return match ($index) {
            1 => 'minutes',
            2 => 'hours',
            3 => 'days',
            default => null
        };
    }

    public function save(): void
    {
        $this->validate([
            'upload' => ['nullable', 'file', 'size:2048'],
            'title' => ['required'],
            'description' => ['required'],
            'duration' => ['nullable'],
            'durationUnit' => ['nullable'],
            'startedDate' => ['required', 'date_format:Y-m-d', 'after_or_equal:' . now()->format('Y-m-d')],
            'startedTime' => ['required', 'date_format:H:i:s', 'after_or_equal:' . now()->format('H:i:s')],
        ]);

        DB::transaction(function () {
            if ($this->assignment === null) {
                $this->createAssignment();
                return;
            }

            $this->updateAssignment();
        });

    }

    public function saved(): void
    {
        $this->makeAttachment();
        $this->assignToAgenda();
        $this->dispatch('reload')->to(Panel::class);
        $this->closeModal();
    }

    protected function makeAttachment(): void
    {
        if (! $this->upload instanceof TemporaryUploadedFile) {
            return;
        }

        $data = [
            'size' => $this->upload->getSize(),
            'mime' => $this->upload->getMimeType(),
            'user_id' => auth()->id(),
            'path' => 'assignments/' . $this->assignment->id . '/'.now()->format('Ymd-His') .'/'. $this->upload->getFilename(),
        ];

        if ( false === $this->upload->store($data['path'], 'cloudflare-s3')) {
            return;
        }

        $attachment = Attachment::query()->create($data);
        $this->assignment->attachments()->attach($attachment->id);

    }

    protected function createAssignment(): void
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'duration_unit' => $this->chooseDurationUnit($this->durationUnit),
            'duration' => $this->duration,
            'started_at' => $this->startedDate . ' ' . $this->startedTime,
        ];

        $assignment = new Assignment($data);
        $assignment->course()->associate($this->course)->save();

        $this->assignment = $assignment;
        $this->saved();
    }

    protected function updateAssignment(): void
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'duration_unit' => $this->chooseDurationUnit($this->durationUnit),
            'duration' => $this->duration,
        ];

        $this->assignment->update($data);

        $this->saved();
    }

    protected function setStartedDateAndTime(): void
    {
        $startedAt = $this->assignment?->getAttribute('started_at') ?? now()->timezone(config('app.timezone'))->format('Y-m-d H:i');
        [$date, $time] = explode(' ', $startedAt);

        $this->startedDate = $date;
        $this->startedTime = $time;
    }

    protected function convertDurationUnit(?string $unit): ?string
    {
        if ($unit === null) {
            return null;
        }

        return match ($unit) {
            'minutes' => 1,
            'hours' => 2,
            'days' => 3,
            default => null
        };
    }

    protected function assignToAgenda(): void
    {
        $this->course->enrollments->each(function (Enrollment $enrollment) {
            $enrollment->user->agendas()
                ->create([
                    'going_at' => $this->assignment->getAttribute('started_at'),
                    'title' => "Assignment: " . $this->assignment?->title ?? '',
                    'subtitle' => $this->course?->title ?? '',
                    'action_url' => route('courses.assignment.show', [
                        'course' => $this->course, 'assignment' => $this->assignment]),
                    'course_id' => $enrollment->getAttribute('course_id'),
                ]);
        });

    }

    public function render(): View
    {
        return view('livewire.dashboard.assignment.form');
    }
}
