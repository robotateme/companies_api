<?php

namespace App\DTOs\Company;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class SearchInRectangleDto extends Data
{
    public float $latitude;
    public float $longitude;
    #[MapInputName('opposite_latitude')]
    public float $oppositeLatitude;
    #[MapInputName('opposite_longitude')]
    public float $oppositeLongitude;
    public function __construct(
        //
    ) {}
}
