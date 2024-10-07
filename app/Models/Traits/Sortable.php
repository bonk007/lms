<?php

namespace App\Models\Traits;

use App\Models\Topic;
use Illuminate\Support\Facades\DB;

trait Sortable
{
    /**
     * Rearrange position of the model to one step up
     * @return \App\Models\Topic|\App\Models\Section|\App\Models\Traits\Sortable
     */
    public function stepUp(): self
    {
        if (!$this->exists()) {
            return $this;
        }

        $parent = $this->parentRelation();

        $previous = static::query()
            ->whereBelongsTo(...$parent)
            ->where('sort_index', '<', $this->getAttribute('sort_index'))
            ->orderByDesc('sort_index')
            ->first();

        $this->switchPosition($previous);

        return $this;
    }

    /**
     * Rearrange position of the model to one step down
     * @return \App\Models\Topic|\App\Models\Section|\App\Models\Traits\Sortable
     */
    public function stepDown(): self
    {
        if (!$this->exists) {
            return $this;
        }

        $parent = $this->parentRelation();

        $previous = static::query()
            ->whereBelongsTo(...$parent)
            ->where('sort_index', $this->getAttribute('sort_index') + 1)
            ->orderByDesc('sort_index')
            ->first();

        $this->switchPosition($previous, 'down');

        return $this;
    }

    /**
     * Rearrange sort index with next/previous model
     *
     * @param \App\Models\Topic|null $sibling
     * @param string $direction
     */
    protected function switchPosition(?Topic $sibling = null, string $direction = 'up'): void
    {
        DB::transaction(function () use ($sibling, $direction) {
            $sibling?->increment('sort_index', $direction === 'up' ? 1 : -1);
            $this->increment('sort_index', $direction === 'up' ? -1 : 1);
        });
    }

    /**
     * Initialize index for fresh model
     * @return \App\Models\Topic|\App\Models\Section|\App\Models\Traits\Sortable
     */
    protected function initSortIndex(): self
    {
        if ($this->exists) {
            return $this;
        }

        $parent = $this->parentRelation();

        $latest = static::query()
            ->whereBelongsTo(...$parent)
            ->orderByDesc('sort_index')
            ->first();

        return $this->setAttribute('sort_index', ((int) $latest?->getAttribute('sort_index')) + 1);
    }

    /**
     * Return should be [$model, 'relation-name']
     * @return array
     */
    abstract protected function parentRelation(): array;
}
