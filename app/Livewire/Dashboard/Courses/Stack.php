<?php

namespace App\Livewire\Dashboard\Courses;

use App\Services\Course\Query;
use App\Services\Course\Service;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Stack extends Component
{
    public string $search = '';

    public array $sortingOptions = [];

    public string $orderBy = '';

    public string $orderDir = 'desc';

    protected Service $service;

    public function boot(): void
    {
        $this->service = new Service(auth()->user());
        $this->sortingOptions = Query::orderingOptions();
        $this->orderBy = 'name';
    }

    public function changeOrderBy(string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function changeOrderDir(string $dir): void
    {
        $this->orderDir = $dir;
    }

    public function render(): View
    {
        return view('livewire.dashboard.courses.stack', [
            'courses' => $this->service->get([
                'search' => $this->search
            ], [
                'orderBy' => $this->orderBy,
                'direction' => $this->orderDir
            ])
        ]);
    }
}
