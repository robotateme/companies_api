<?php

namespace App\DTOs\Company\Output;

use Spatie\LaravelData\Data;

class SearchByActivityTitleResultDto extends Data
{
    public function __construct(
        public string $activity,
        public string $company,
        public int $id,
    ) {}
}
