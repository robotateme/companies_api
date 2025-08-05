<?php

namespace App\DTOs\Company\Output;

use Spatie\LaravelData\Data;

/**
 * @class SearchByActivityTitleResultDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Companies by activity title result",
 *     description="Результат выборки",
 *     schema="CompanyActivityResult",
 * )
 */
class SearchByActivityTitleResultDto extends Data
{
    public function __construct(
        /**
         * @var int $id
         * @OA\Property (format="integer", title="id", property="id", example="1")
         */
        public int $id,
        /**
         * @var int $activity
         * @OA\Property (format="string", title="activity", property="activity", example="Activity name"),
         */
        public string $activity,
        /**
         * @var int $company
         * @OA\Property (format="string", title="company", property="company", example="Company name"),
         */
        public string $company,
    ) {}
}
