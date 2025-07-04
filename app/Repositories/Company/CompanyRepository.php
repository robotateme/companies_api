<?php

namespace App\Repositories\Company;

use App\DTOs\Company\SearchInRadiusDto;
use App\DTOs\Company\SearchInRectangleDto;
use App\Enums\MetricConstEnum;
use App\Models\Activity;
use App\Repositories\Contracts\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{

    /**
     * @param SearchInRadiusDto $dto
     * @param int $const
     * @return Collection
     */
    public function getInRadius(SearchInRadiusDto $dto, int $const = MetricConstEnum::METERS->value): mixed
    {
        return $this->searchInAreaQuery($dto->latitude, $dto->longitude, $const)
            ->join('buildings', 'companies.building_id', '=', 'buildings.id')
            ->addSelect('buildings.latitude', 'buildings.longitude', 'buildings.address', 'companies.*')
            ->having('distance', '<=', $dto->distance)
            ->get();
    }

    /**
     * @param SearchInRectangleDto $dto
     * @param int $const
     * @return mixed
     */
    public function getInRectangle(SearchInRectangleDto $dto, int $const = MetricConstEnum::METERS->value): mixed
    {
        $centerLatitude = ($dto->latitude + $dto->oppositeLatitude) / 2;
        $centerLongitude = ($dto->oppositeLongitude + $dto->oppositeLongitude) / 2;

        return $this->searchInAreaQuery($centerLatitude, $centerLongitude, $const)
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
            ->get();
    }


    /**
     * @param string $query
     * @return mixed
     */
    public function searchByActivityTitle(string $query): mixed
    {
        $query = Activity::whereLike('title', "$query%")
            ->unionAll(
                Activity::select('activities.*')
                    ->join('cte', 'cte.id', '=', 'activities.activity_id')
            );
        $result = Activity::from('cte')->withRecursiveExpression('cte', $query)
            ->select(['companies.id', 'cte.id as activity_id', 'cte.title', 'companies.title as company'])
            ->join('company_activity', 'cte.id', '=', 'company_activity.activity_id')
            ->join('companies', 'companies.id', '=', 'company_activity.company_id');

        return $result->get()->toArray();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param int $const
     * @return Builder
     */
    private function searchInAreaQuery(float $latitude, float $longitude, int $const): Builder
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

    /**
     * @param int $activityId
     * @return mixed
     */
    public function getByActivity(int $activityId): mixed
    {
        return $this->getBuilder()
            ->select('companies.*')
            ->join('company_activity', 'companies.id', '=', 'company_activity.company_id')
            ->where('company_activity.id', $activityId)
            ->get()
            ->toArray();
    }

    /**
     * @param int $companyId
     * @return mixed
     */
    public function getOne(int $companyId): mixed
    {
        return $this->getBuilder()->find($companyId)
            ->first()
            ->toArray();
    }

    /**
     * @param int $buildingId
     * @return mixed
     */
    public function getByBuilding(int $buildingId): mixed
    {
        return $this->getBuilder()
            ->where('building_id', '=', $buildingId)
            ->get();
    }


    /**
     * @param int $companyName
     * @return mixed
     */
    public function searchByName(int $companyName): mixed
    {
        return $this->getBuilder()
            ->whereLike('title', "$companyName%")
            ->get();
    }
}
