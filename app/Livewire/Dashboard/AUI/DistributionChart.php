<?php

namespace App\Livewire\Dashboard\AUI;

use App\Livewire\Dashboard\AUI\Concerns\WithDistribution;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class DistributionChart extends Component
{
    use WithDistribution;

    public Collection $data;

    public function mount(): void
    {
        $course = Course::query()
            ->withCount('enrollments')
            ->whereBelongsTo(auth()->user(), 'creator')
            ->orderBy('id')
            ->first();

        $data = $this->getData($course);
        $total = $data->get('total');
        $sum = $data->get('low') + $data->get('medium') + $data->get('high');
        $anomaly = $total - $sum;

        $low = $data->get('low') < 1 ? 0 : round($data->get('low') / $total, 2);
        $medium = $data->get('medium') < 1 ? 0 : round($data->get('medium') / $total, 2);
        $high = $data->get('high') < 1 ? 0 : round($data->get('high') / $total, 2);
        $unknown = $anomaly < 1 ? 0 : round($anomaly / $total, 2);


        $this->data = collect([
            ['name' => 'Tinggi', 'y' => $high],
            ['name' => 'Medium', 'y' => $medium],
            ['name' => 'Rendah', 'y' => $low],
            ['name' => 'Tidak Diketahui', 'y' => $unknown],
        ]);
    }

    public function render(): View
    {
        return view('livewire.dashboard.aui.distribution-chart');
    }
}
