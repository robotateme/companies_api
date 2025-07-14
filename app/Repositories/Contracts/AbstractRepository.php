<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
abstract class AbstractRepository
{
    /**
     * @param  Model  $model
     */
    public function __construct(private readonly Model $model)
    {
    }

    /**
     * @return Builder
     */
    protected function getBuilder(): Builder
    {
        return $this->model->newModelQuery();
    }

    /**
     * @param int $id
     * @return iterable
     */
    public function getOne(int $id): iterable
    {
        return $this->getBuilder()->find($id)
            ->first()
            ->toArray();
    }
}
