<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\SearchInRadiusDto;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Services\Company\Contracts\RadiusSearchScenarioInterface;
use Illuminate\Contracts\Support\Arrayable;

readonly class RadiusSearchScenario implements RadiusSearchScenarioInterface
{

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        private CompanyRepositoryInterface $companyRepository)
    {}

    /**
     * @param SearchInRadiusDto $dto
     * @return Arrayable|array
     */
    public function handle(SearchInRadiusDto $dto): Arrayable|array
    {
        return $this->companyRepository->getInRadius($dto);
    }
}
