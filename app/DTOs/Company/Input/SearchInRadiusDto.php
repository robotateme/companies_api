<?php

namespace App\DTOs\Company\Input;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @class SearchInRadiusDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Search companies in radius data",
 *     description="Данные для поиска компаний по карте в радусе",
 *     schema="SearchInRadius",
 *     required={"latitude","longitude", "distance", "metric"},
 * )
 */
class SearchInRadiusDto extends Data
{
    /**
     * @var float $latitude
     * @OA\Property (format="float", title="latitude", property="latitude", example="44.604010")
     */
    public float $latitude;
    /**
     * @var float $longitude
     * @OA\Property (format="float", title="longitude", property="longitude", example="33.483109")
     */
    public float $longitude;
    /**
     * @var int $distance
     * @OA\Property (format="integer", title="distance", property="distance", example="200")
     */
    public int $distance;
    /**
     * @var string $metricUnit
     * @OA\Property (format="string", title="metric", property="metric", example="m")
     */
    #[MapInputName('metric')]
    public string $metricUnit;

    public function __construct(
        //
    ) {}
}
