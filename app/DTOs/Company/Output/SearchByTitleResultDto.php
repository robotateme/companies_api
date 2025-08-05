<?php

namespace App\DTOs\Company\Output;

use DateTimeInterface;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;
/**
 * @class SearchByTitleResultDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Companies result",
 *     description="Результат поиска по названию",
 *     schema="CompanyByTitle",
 * )
 */
class SearchByTitleResultDto extends Data
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
         * @var int $address
         * @OA\Property (format="string", title="address", property="address", example="Test street 33 778888"),
         */
        public string $address,

        /**
         * @var int $phones
         * @OA\Property (format="string", title="phones", property="phones", example="+78786661313"),
         */
        public string $phones,

        #[MapInputName('created_at')]
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        public DateTimeInterface $createdAt,
    ) {}
}
