<?php

namespace App\DTOs\Company\Output;

use DateTimeInterface;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

class SearchByTitleResultDto extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $address,
        public string $phones,

        #[MapInputName('created_at')]
        #[WithTransformer(DateTimeInterfaceTransformer::class)]
        public DateTimeInterface $createdAt,
    ) {}
}
