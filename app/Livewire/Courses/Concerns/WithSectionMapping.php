<?php

namespace App\Livewire\Courses\Concerns;

use App\Models\AUI\Stepper\SectionMapping;
use Illuminate\Database\Eloquent\Collection;

trait WithSectionMapping
{
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
