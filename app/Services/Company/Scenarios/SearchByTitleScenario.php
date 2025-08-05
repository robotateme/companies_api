<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Input\SearchByTitleDto;
use App\DTOs\Company\Output\SearchByTitleResultDto;
use App\Repositories\Company\SearchCompanyRepository;

readonly class SearchByTitleScenario
{

    public function __construct(private SearchCompanyRepository $searchCompanyRepository)
    {
    }

    /**
     * @param SearchByTitleDto $dto
     * @return iterable
     */
    public function handle(SearchByTitleDto $dto): iterable
    {
        $resultData = $this->searchCompanyRepository->searchByTitle($dto->query);
        return SearchByTitleResultDto::collect($resultData);
    }
}
