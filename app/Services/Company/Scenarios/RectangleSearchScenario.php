<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Input\SearchInRectangleDto;
use App\DTOs\Company\Output\SearchInAreaResultDto;
use App\Repositories\Company\Contracts\AbstractSearchCompanyInArea;
use App\Repositories\Company\SearchCompanyInAreaRepository;
use App\Services\Company\Contracts\RectangleSearchScenarioInterface;

readonly class RectangleSearchScenario implements RectangleSearchScenarioInterface
{

    /**
     * @param SearchCompanyInAreaRepository $companyRepository
     */
    public function __construct(
        private AbstractSearchCompanyInArea $companyRepository)
    {}

    /**
     * @param SearchInRectangleDto $dto
     * @return iterable
     */
    public function handle(SearchInRectangleDto $dto) : iterable
    {
        $resultData = $this->companyRepository->searchInRectangle($dto);
        return SearchInAreaResultDto::collect($resultData);
    }
}
