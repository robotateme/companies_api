<?php

namespace App\DTOs\Company;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class SearchInRadiusDto extends Data
{
    public float $latitude;
    public float $longitude;
    public int $distance;
    #[MapInputName('metric')]
    public string $metricUnit;

    public function __construct(
        //
    ) {}
}
