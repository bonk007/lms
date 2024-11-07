<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class Activity
{
    public function __construct(protected User $user)
    {
    }

    public function all(int $limit = 30): LengthAwarePaginator
    {
        return $this->query()->paginate($limit);
    }

    /**
     * @throws \JsonException
     */
    public function touch(string $url, array $data = []): void
    {
        DB::table('activities')->insert([
            'created_at' => now()->format("Y-m-d H:i:s"),
            'user_id' => $this->user->id,
            'url' => $url,
            'data' => json_encode($data, JSON_THROW_ON_ERROR),
        ]);
    }

    public function latest(): ?array
    {
        $result = $this->query()
            ->orderBy('activities.created_at', 'desc')
            ->limit(1)
            ->first();

        if (null === $result) {
            return null;
        }

        return (array) $result;
    }

    protected function query(): Builder
    {
        return DB::table('activities')
            ->select('activities.*')
            ->join('users', 'users.id', '=', 'activities.user_id')
            ->where('activities.user_id', $this->user->id)
            ->orderBy('activities.created_at', 'desc');
    }
}
