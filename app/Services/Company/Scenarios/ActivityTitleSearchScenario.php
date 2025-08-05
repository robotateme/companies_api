<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Input\SearchByActivityTitleDto;
use App\DTOs\Company\Output\SearchByActivityTitleResultDto;
use App\Repositories\Company\SearchCompanyRepository;

readonly class ActivityTitleSearchScenario
{
    public function __construct(private SearchCompanyRepository $repository)
    {

    }

    /**
     * @param SearchByActivityTitleDto $dto
     * @return iterable
     */
    public function handle(SearchByActivityTitleDto $dto): iterable
    {
        $resultData = $this->repository->searchByActivityTitle($dto->query);
        return SearchByActivityTitleResultDto::collect($resultData);
    }
}
