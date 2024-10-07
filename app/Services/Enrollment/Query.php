<?php

namespace App\Services\Enrollment;

use App\Services\BaseQuery;
use App\Services\Contracts\QueryContract;

class Query extends BaseQuery
{
    public function filter(array $filters = []): QueryContract
    {
        return $this;
    }

    public function orderBy(string $orderBy, string $direction): QueryContract
    {
        return $this;
    }
}
