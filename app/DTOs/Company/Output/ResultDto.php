<?php

namespace App\DTOs\Company\Output;

use Spatie\LaravelData\Data;

/**
 * @class ResultDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Companies result",
 *     description="Результат выборки",
 *     schema="CompanyResult",
 * )
 */
class ResultDto extends Data
{
    public function __construct(
        /**
         * @var int $id
         * @OA\Property (format="integer", title="id", property="id", example="1")
         */
        public int $id,
        /**
         * @var int $title
         * @OA\Property (format="string", title="title", property="title", example="Company name"),
         */
        public string $title,
        /**
         * @var int $phones
         * @OA\Property (format="string", title="phones", property="phones", example="+78786661313"),
         */
        public string $phones,
        /**
         * @var int $address
         * @OA\Property (format="string", title="address", property="address", example="Test street 33 778888"),
         */
        public string $address,
    ) {}
}
