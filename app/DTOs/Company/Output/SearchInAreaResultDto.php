<?php

namespace App\DTOs\Company\Output;

use DateTimeInterface;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

/**
 * @class SearchInAreaResultDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Companies result",
 *     description="Результат поиска по площадям",
 *     schema="CompanyInAreaResult",
 * )
 */
class SearchInAreaResultDto extends Data
{
    public function __construct(
        /**
         * @var int $id
         * @OA\Property (format="integer", title="id", property="id", example="1")
         */
        public int $id,
        /**
         * @var int $title
         * @OA\Property (format="string", title="title", property="title", example="Продуктовый магазин на Гавена 20А")
         */
        public string $title,
        /**
         * @var int $address
         * @OA\Property (format="string", title="address", property="address", example="улица Гавена, 20А, Севастополь 299028")
         */
        public string $address,
        /**
         * @var int $phones
         * @OA\Property (format="string", title="phones", property="phones", example="+496138009915")
         */
        public string $phones,
        /**
         * @var int $latitude
         * @OA\Property (format="float", title="latitude", property="latitude", example="44.604392")
         */
        public float $latitude,
        /**
         * @var int $longitude
         * @OA\Property (format="float", title="longitude", property="longitude", example="33.484801")
         */
        public float $longitude,
        /**
         * @var int $distance
         * @OA\Property (format="float", title="distance", property="distance", example="140.52556774327596")
         */
        public float $distance,

        /**
         * @var int $createdAt
         * @OA\Property (format="float", title="createdAt", property="createdAt", example="05-08-2025 22:52:27")
         */
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        public DateTimeInterface $createdAt,
    ) {}
}
