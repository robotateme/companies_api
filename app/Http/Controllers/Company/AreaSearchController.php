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

class AreaSearchController extends Controller
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
     */
    public function searchInRectangle(SearchInRectangleRequest $request): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->rectangleSearchScenario->handle($dto)
        ]);
    }


    /**
     * @param SearchInRadiusRequest $request
     * @return JsonResponse
     */
    public function searchInRadius(SearchInRadiusRequest $request): JsonResponse
    {
        $dto = SearchInRadiusDto::from($request->validated());
        return new JsonResponse([
            'data' => $this->radiusSearchScenario->handle($dto)
        ]);
    }
}
