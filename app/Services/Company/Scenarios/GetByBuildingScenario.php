<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Output\ResultDto;
use App\Repositories\Company\CompanyRepository;

readonly class GetByBuildingScenario
{

    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    /**
     * @param int $buildingId
     * @return iterable
     */
    public function handle(int $buildingId): iterable
    {
        $resultData = $this->companyRepository->getByBuilding($buildingId);
        return ResultDto::collect($resultData);
    }
}
