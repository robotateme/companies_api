<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\SearchInRectangleDto;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Services\Company\Contracts\RectangleSearchScenarioInterface;
use Illuminate\Contracts\Support\Arrayable;

readonly class RectangleSearchScenario implements RectangleSearchScenarioInterface
{

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        private CompanyRepositoryInterface $companyRepository)
    {}

    public function handle(SearchInRectangleDto $dto) : Arrayable|array
    {
        return $this->companyRepository->getInRectangle($dto);
    }
}
