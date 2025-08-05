<?php

namespace App\Repositories\Company;

use App\Models\Activity;
use App\Repositories\Company\Contracts\SearchCompanyRepositoryInterface;
use App\Repositories\Contracts\AbstractRepository;

class SearchCompanyRepository extends AbstractRepository implements SearchCompanyRepositoryInterface
{
    /**
     * @param string $companyName
     * @return array
     */
    public function searchByTitle(string $companyName): iterable
    {
        return $this->getBuilder()
            ->select('*')
            ->addSelect('buildings.address')
            ->whereLike('title', "%$companyName%")
            ->join('buildings', 'building_id', '=', 'buildings.id')
            ->get();
    }

    /**
     * @param string $query
     * @return iterable
     * with recursive `cte` as ((select * from `activities` where `title` like "Еда%")
     * union all
     * (select `activities`.*
     * from `activities`
     * inner join `cte` on `cte`.`id` = `activities`.`activity_id`))
     * select cte.title, company_id, ca.activity_id from company_activity ca join cte on cte.id=ca.activity_id
     * (Alternative query))
     */
    public function searchByActivityTitle(string $query): iterable
    {
        $query = Activity::whereLike('title', "$query%")->distinct()
            ->selectRaw('activities.*, 1 as level')
            ->unionAll(
                Activity::selectRaw('activities.*, cte.level + 1')
                    ->join('cte', 'cte.id', '=', 'activities.activity_id')
            );
        $result = Activity::from('cte')->withRecursiveExpression('cte', $query)
            ->where('level', '<=', 3)
            ->select(
                [
                    'companies.id',
                    'companies.title as company',
                    'cte.title as activity',
                ])
            ->join('company_activity', 'cte.id', '=', 'company_activity.activity_id')
            ->join('companies', 'companies.id', '=', 'company_activity.company_id')
        ;
        return $result->get()->toArray();
    }
}
