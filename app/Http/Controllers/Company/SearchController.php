<?php

namespace App\Http\Controllers\Company;

use App\DTOs\Company\SearchInRadiusDto;
use App\DTOs\Company\SearchInRectangleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchInRadiusRequest;
use App\Http\Requests\SearchInRectangleRequest;
use App\Services\Company\Scenarios\RadiusSearchScenario;
use App\Services\Company\Scenarios\RectangleSearchScenario;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function __construct(
        private readonly RectangleSearchScenario $rectangleSearchScenario,
        private readonly RadiusSearchScenario    $radiusSearchScenario,
    )
    {
    }

    /**
     * @param SearchInRectangleRequest $request
     * @return JsonResponse
     *
     * For testing
     * 44.604010, 33.483109
     * 44.600285, 33.489828
     */
    public function searchInRectangle(SearchInRectangleRequest $request): JsonResponse
    {
        $dto = SearchInRectangleDto::from($request->validated());
        return new JsonResponse([
            'data' => $this->rectangleSearchScenario->handle($dto)
        ]);
    }


    /**
     * @param SearchInRadiusRequest $request
     * @return JsonResponse
     * For Testing
     * 44.604010, 33.483109
     * 200m
     */
    public function searchInRadius(SearchInRadiusRequest $request): JsonResponse
    {
        $dto = SearchInRadiusDto::from($request->validated());
        return new JsonResponse([
            'data' => $this->radiusSearchScenario->handle($dto)
        ]);
    }
}
