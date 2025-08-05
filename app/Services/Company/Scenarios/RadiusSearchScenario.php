<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Input\SearchInRadiusDto;
use App\DTOs\Company\Output\SearchInAreaResultDto;
use App\Repositories\Company\Contracts\AbstractSearchCompanyInArea;
use App\Repositories\Company\SearchCompanyInAreaRepository;
use App\Services\Company\Contracts\RadiusSearchScenarioInterface;

readonly class RadiusSearchScenario implements RadiusSearchScenarioInterface
{

    /**
     * @param SearchCompanyInAreaRepository $companyRepository
     */
    public function __construct(
        private AbstractSearchCompanyInArea $companyRepository)
    {}

    /**
     * @param SearchInRadiusDto $dto
     * @return iterable
     */
    public function handle(SearchInRadiusDto $dto): iterable
    {
        $resultData = $this->companyRepository->searchInRadius($dto);
        return SearchInAreaResultDto::collect($resultData);
    }
}
