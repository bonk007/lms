<?php

namespace App\Services;

use App\Services\Contracts\QueryContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline as BasePipeline;
use Illuminate\Support\Facades\Pipeline;

abstract class BaseQuery implements QueryContract
{
    protected ?BasePipeline $pipeline = null;
    public function __construct(protected Builder $query)
    {
        $this->pipeline();
    }

    public function build(): Builder
    {
        return $this->pipeline->thenReturn();
    }

    protected function pipeline(): BasePipeline
    {
        if ($this->pipeline === null) {
            $this->pipeline = Pipeline::send($this->query);
        }

        return $this->pipeline;
    }
}
