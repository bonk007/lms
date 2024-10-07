<?php

namespace App\Livewire\Dashboard\Resources;

use App\Models\Resource;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Stack extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search  = '';

    public string $groupBy  = 'all';

    public bool $hasSelection = false;

    public $selectedResource = null;


    public array $groups = [
        'all' => 'All',
        'no-trashed' => 'No Trashed',
        'trashed-only' => 'Trashed Only',
    ];

    protected $listeners = [
        'delete',
        'flush',
        'restore'
    ];

    public function selectResource(): void
    {
        $this->dispatch('resource-selected', ['resource' => $this->selectedResource]);
    }

    protected function query(): Builder
    {
        return Resource::query()
            ->whereBelongsTo(auth()->user(), 'creator')
            ->when(strlen($this->search) > 2, fn(Builder $query) => $query->whereNested(
                fn ($query) =>
                    $query->where('title', 'ilike', strtolower($this->search) . '%')
                        ->orWhere('abstract', 'ilike', strtolower($this->search) . '%')
                        ->orWhere('html_content', 'ilike', strtolower($this->search) . '%')
            ))
            ->when($this->groupBy === 'all', fn(Builder $query) => $query->withTrashed())
            ->when($this->groupBy === 'no-trashed', fn(Builder $query) => $query->withoutTrashed())
            ->when($this->groupBy === 'trashed-only', fn(Builder $query) => $query->onlyTrashed());
    }

    public function delete(Resource $resource): void
    {
        $resource->delete();
    }

    public function restore(int $resource): void
    {
        /** @var null|\App\Models\Resource $model */
        $model = $this->query()->withTrashed()->find($resource, 'id');
        $model?->restore();
    }

    public function flush(int $resource): void
    {
        $model = $this->query()->withTrashed()->find($resource, 'id');
        $model?->forceDelete();
    }

    public function onSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $resources = $this->query()->paginate(10);
        return view('livewire.dashboard.resources.stack', compact('resources'));
    }
}
