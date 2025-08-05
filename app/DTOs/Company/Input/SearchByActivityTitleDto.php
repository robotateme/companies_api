<?php

namespace App\DTOs\Company\Input;

use Spatie\LaravelData\Data;

/**
 * @class SearchByActivityTitleDto
 * @package App\DTOs\Company
 * @OA\Schema(
 *     title="Search companies by activity title (recursive)",
 *     description="Поиск по имени рода деятеольности, рекурсивно",
 *     schema="SearchByActivityTitle",
 *     required={"query"},
 * )
 */
class SearchByActivityTitleDto extends Data
{
    /**
     * @var string $query
     * @OA\Property (format="string", title="query", property="query", example="Еда")
     */
    public string $query;
}
