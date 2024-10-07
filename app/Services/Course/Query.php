<?php

namespace App\Services\Course;

use App\Services\BaseQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Pipeline\Pipeline as BasePipeline;

class Query extends BaseQuery
{
    protected ?BasePipeline $pipeline = null;

    public function filter(array $filters = []): self
    {
        $sanitizedFilters = $this->sanitizeFilters($filters);
        $this->pipeline->pipe([
            function (Builder $query, $next) use ($sanitizedFilters) {
                $query->when($sanitizedFilters['instance'] !== 'all', fn(Builder $query) => $query->where('instance_id', $sanitizedFilters['instance']))
                    ->when(!empty($sanitizedFilters['search']), fn(Builder $query) => $query->whereNested(fn (Builder $query)
                    => $query->where('name', 'ilike', $sanitizedFilters['search'] . '%')
                        ->orWhere('description', 'ilike', '%'. $sanitizedFilters['search'] . '%')));
                return $next($query);
            },
            function (Builder $query, $next) use ($sanitizedFilters) {
                $query->when($sanitizedFilters['withTrashes'], fn(Builder $query) => $query->withTrashed());
                return $next($query);
            },
            function (Builder $query, $next) use ($sanitizedFilters) {
                $query->when($sanitizedFilters['trashed'], fn(Builder $query) => $query->onlyTrashed());
                return $next($query);
            },
        ]);

        return $this;
    }

    public function orderBy(string $orderBy, string $direction): self
    {
        $this->pipeline->pipe(function (Builder $query, $next) use ($orderBy, $direction) {
            return $next($query->orderBy($orderBy, $direction));
        });

        return $this;
    }

    public static function defaultFilters(): array
    {
        return [
            'search' => null,
            'instance' => 'all',
            'withTrashes' => false,
            'trashed' => false
        ];
    }

    public static function orderingOptions(): array
    {
        return [
            ['id' => 'name', 'label' => __('Name')],
            ['id' => 'created_at', 'label' => __('Created at')],
            ['id' => 'participants', 'label' => 'Participants Number'],
            ['id' => 'topics', 'label' => 'Topics Number'],
        ];
    }

    protected function sanitizeFilters(array $needle): array
    {
        $filters = static::defaultFilters();
        return [
            ...$filters,
            ...Arr::only($needle, array_keys($filters))
        ];
    }

}
