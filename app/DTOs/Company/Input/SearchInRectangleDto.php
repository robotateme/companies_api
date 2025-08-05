<?php

namespace App\DTOs\Company\Input;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

/**
 * @class SearchInRectangleDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Search companies in rectangle data",
 *     description="Данные для поиска компаний по карте в прямоугольнике/квадрате",
 *     schema="SearchInRectangle",
 *     required={"latitude","longitude", "oppositeLatitude", "oppositeLatitude"},
 * )
 */
class SearchInRectangleDto extends Data
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
     * @var float $oppositeLatitude
     * @OA\Property (format="float", title="opposite_latitude", property="opposite_latitude", example="44.600285")
     */
    #[MapInputName('opposite_latitude')]
    public float $oppositeLatitude;
    /**
     * @var float $oppositeLongitude
     * @OA\Property (format="float", title="opposite_longitude", property="opposite_longitude", example="33.489828")
     */
    #[MapInputName('opposite_longitude')]
    public float $oppositeLongitude;
    public function __construct(
        //
    ) {}
}
