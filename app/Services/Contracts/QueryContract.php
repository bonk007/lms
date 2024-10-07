<?php

namespace App\Services\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface QueryContract
{
    public function filter(array $filters = []): self;

    public function orderBy(string $orderBy, string $direction): self;


    public function build(): Builder;
}
