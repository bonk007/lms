<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Service
{
    public function __construct(protected ?User $user)
    {
    }

    public function get(array $filters, array $orders, bool|int $pagination = 10): Collection|LengthAwarePaginator
    {
        $baseQuery = Course::query()
            ->when($this->user instanceof User, fn (Builder $query) => $query->whereBelongsTo($this->user, 'creator'));

        $query = (new Query($baseQuery))
            ->filter($filters)
            ->orderBy(orderBy: $orders['orderBy'], direction: $orders['direction'])
            ->build();

        return $pagination === false ? $query->get() : $query->paginate($pagination);
    }
}
