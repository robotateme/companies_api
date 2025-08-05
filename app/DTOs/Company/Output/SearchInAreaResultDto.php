<?php

namespace App\DTOs\Company\Output;

use DateTimeInterface;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class SearchInAreaResultDto extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $address,
        public string $phones,
        public float $latitude,
        public float $longitude,
        public float $distance,
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        public DateTimeInterface $createdAt,
    ) {}
}
