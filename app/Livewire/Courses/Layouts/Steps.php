<?php

namespace App\Livewire\Courses\Layouts;

use App\Livewire\Courses\Concerns\WithSectionMapping;
use App\Models\Course;
use Livewire\Component;

class Steps extends Component
{
    use WithSectionMapping;

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
}
