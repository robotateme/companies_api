<?php

namespace App\DTOs\Company\Input;

use Spatie\LaravelData\Data;

/**
 * @class SearchByTitleDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Search companies by title",
 *     description="Поиск по имени",
 *     schema="SearchByTitle",
 *     required={"query"},
 * )
 */
class SearchByTitleDto extends Data
{
    /**
     * @var string $query
     * @OA\Property (format="string", title="query", property="query", example="Гагарина")
     */
    public string $query;
    public function __construct(
        //
    ) {}
}
