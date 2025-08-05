<?php

namespace App\Services\Company\Scenarios;

use App\DTOs\Company\Output\ResultDto;
use App\Repositories\Company\CompanyRepository;

readonly class GetByActivityScenario
{

    public function __construct(private CompanyRepository $companyRepository)
    {
    }

    /**
     * @param int $id
     * @return iterable
     */
    public function handle(int $id) : iterable
    {
        $resultData = $this->companyRepository->getByActivity($id);
        return ResultDto::collect($resultData);
    }
}
