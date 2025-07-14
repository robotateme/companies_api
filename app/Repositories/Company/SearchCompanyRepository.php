<?php

namespace App\Repositories\Company;

use App\Models\Activity;
use App\Repositories\Company\Contracts\SearchCompanyRepositoryInterface;
use App\Repositories\Contracts\AbstractRepository;

class SearchCompanyRepository extends AbstractRepository implements SearchCompanyRepositoryInterface
{
    /**
     * @param int $companyName
     * @return array
     */
    public function searchByTitle(int $companyName): array
    {
        return $this->getBuilder()
            ->whereLike('title', "$companyName%")
            ->get()
            ->toArray();
    }

    /**
     * @param string $query
     * @return iterable
     */
    public function searchByActivityTitle(string $query): iterable
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
}
