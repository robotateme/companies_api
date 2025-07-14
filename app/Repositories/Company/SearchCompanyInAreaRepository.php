<?php

namespace App\Repositories\Company;

use App\DTOs\Company\SearchInRadiusDto;
use App\DTOs\Company\SearchInRectangleDto;
use App\Enums\MetricConstEnum;
use App\Repositories\Company\Contracts\AbstractSearchCompanyInArea;
use Illuminate\Database\Eloquent\Builder;

class SearchCompanyInAreaRepository extends AbstractSearchCompanyInArea
{
    /**
     * @param SearchInRadiusDto $dto
     * @param int $const
     * @return iterable
     */
    public function searchInRadius(SearchInRadiusDto $dto, int $const = MetricConstEnum::METERS->value): iterable
    {
        return $this->searchInAreaQuery($dto->latitude, $dto->longitude, $const)
            ->join('buildings', 'companies.building_id', '=', 'buildings.id')
            ->addSelect('buildings.latitude', 'buildings.longitude', 'buildings.address', 'companies.*')
            ->having('distance', '<=', $dto->distance)
            ->get()
            ->toArray();
    }

    /**
     * @param SearchInRectangleDto $dto
     * @return iterable
     */
    public function searchInRectangle(SearchInRectangleDto $dto): iterable
    {
        $centerLatitude = ($dto->latitude + $dto->oppositeLatitude) / 2;
        $centerLongitude = ($dto->oppositeLongitude + $dto->oppositeLongitude) / 2;

        return $this->searchInAreaQuery($centerLatitude, $centerLongitude, MetricConstEnum::METERS->value)
            ->join('buildings', 'companies.building_id', '=', 'buildings.id')
            ->addSelect('buildings.latitude', 'buildings.longitude', 'buildings.address', 'companies.*')
            ->where(function (Builder $builder) use ($dto) {
                $builder->where('buildings.latitude', '<=', $dto->latitude);
                $builder->where('buildings.latitude', '>=', $dto->oppositeLatitude);
            })
            ->where(function (Builder $builder) use ($dto) {
                $builder->where('buildings.longitude', '>=', $dto->longitude);
                $builder->where('buildings.longitude', '<=', $dto->oppositeLongitude);
            })
            ->get()
            ->toArray();
    }
}
