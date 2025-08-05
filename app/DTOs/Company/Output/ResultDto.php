<?php

namespace App\DTOs\Company\Output;

use Spatie\LaravelData\Data;

class ResultDto extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public string $phones,
        public string $address,
    ) {}
}
