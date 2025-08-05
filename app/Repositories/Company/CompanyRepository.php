<?php

namespace App\Repositories\Company;

use App\Models\Activity;
use App\Repositories\Company\Contracts\CompanyRepositoryInterface;
use App\Repositories\Contracts\AbstractRepository;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    /**
     * @param int $activityId
     * @return iterable
     */
    public function getByActivity(int $activityId): iterable
    {
        return $this->getBuilder()
            ->select('companies.*')
            ->addSelect('buildings.address')
            ->join('company_activity', 'companies.id', '=', 'company_activity.company_id')
            ->join('buildings', 'buildings.id', '=', 'companies.building_id')
            ->where('company_activity.id', $activityId)
            ->get()
            ->toArray();
    }

    /**
     * @param int $buildingId
     * @return iterable
     */
    public function getByBuilding(int $buildingId): iterable
    {
        return $this->getBuilder()
            ->where('building_id', '=', $buildingId)
            ->join('buildings', 'buildings.id', '=', 'companies.building_id')
            ->get()
            ->toArray();
    }

}
