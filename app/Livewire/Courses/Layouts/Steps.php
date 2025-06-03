<?php

namespace App\Livewire\Courses\Layouts;

use App\Models\AUI\Stepper\SectionMapping;
use App\Models\Course;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Steps extends Component
{
    public Course $course;

    public int $currentStep = 0;

    public int $lastStep = 0;

    public array $steps = [
        'reading',
        'watching',
        'quiz',
        'discussion',
    ];

    public function mount()
    {
        $this->lastStep = cache('step-' . auth()->user()->id .'-' . $this->course->getKey(), 0);
    }

    public function nextStep(): void
    {
        $this->jumpTo($this->currentStep + 1);
    }

    public function prevStep(): void
    {
        $this->jumpTo($this->currentStep - 1);
    }

    public function jumpTo(int $step): void
    {
        if ($step < 0 || $step >= count($this->steps)) {
            $step = 0;
        }

        if ($this->lastStep < $step) {
            cache()
                ->forever('step-' . auth()->user()->id .'-' . $this->course->getKey(), $step);
            $this->lastStep = $step;
        }

        $this->currentStep = $step;
    }

    public function getStepLabel()
    {
        return $this->steps[$this->currentStep] ?? $this->steps[0];
    }

    public function render()
    {
        $mapping = $this->getMap();
        return view('livewire.courses.layouts.steps', compact('mapping'));
    }

    protected function getMap(): Collection
    {
        return SectionMapping::query()
            ->with(['section.content'])
            ->whereBelongsTo($this->course, 'course')
            ->get()
            ->mapWithKeys(function (SectionMapping $mapping) {
                return [$mapping->getAttribute('marked_as') => $mapping->section?->content];
            });
    }
}
