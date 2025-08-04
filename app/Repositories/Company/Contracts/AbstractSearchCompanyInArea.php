<?php

namespace App\Repositories\Company\Contracts;

use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractSearchCompanyInArea extends AbstractRepository
{
    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $const
     * @return Builder
     */
    protected function searchInAreaQuery(float $latitude, float $longitude, int $const): Builder
    {
        return $this->getBuilder()->selectRaw('( ? * acos( cos( radians(?) ) *
                           cos( radians( latitude ) )
                           * cos( radians( longitude ) - radians(?)
                           ) + sin( radians(?) ) *
                           sin( radians( latitude ) ) )
                         ) AS distance',
            [
                $const,
                $latitude,
                $longitude,
                $latitude,
            ]);
    }
}
