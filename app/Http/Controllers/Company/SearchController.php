<?php

namespace App\Http\Controllers\Company;

use App\DTOs\Company\Input\SearchByActivityTitleDto;
use App\DTOs\Company\Input\SearchByTitleDto;
use App\DTOs\Company\Input\SearchInRadiusDto;
use App\DTOs\Company\Input\SearchInRectangleDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchByActivityTitleRequest;
use App\Http\Requests\SearchByTitleRequest;
use App\Http\Requests\SearchInRadiusRequest;
use App\Http\Requests\SearchInRectangleRequest;
use App\Services\Company\Scenarios\ActivityTitleSearchScenario;
use App\Services\Company\Scenarios\RadiusSearchScenario;
use App\Services\Company\Scenarios\RectangleSearchScenario;
use App\Services\Company\Scenarios\SearchByTitleScenario;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    public function __construct(
        private readonly RectangleSearchScenario $rectangleSearchScenario,
        private readonly RadiusSearchScenario    $radiusSearchScenario,
        private readonly ActivityTitleSearchScenario  $activityTitleSearchScenario,
        private readonly SearchByTitleScenario  $searchByTitleScenario,
    )
    {
    }

    /**
     * @param SearchInRectangleRequest $request
     * @return JsonResponse
     * @OA\Post(
     *     path="/api/company/search/area/rectangle",
     *     summary="Search companies in rectangle",
     *     tags={"Companies search"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/SearchInRectangle"),
     *          ),
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     security={{"bearerAuth":{}}},
     * )
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
     * @OA\Post(
     *     path="/api/company/search/area/radius",
     *     summary="Search companies in radius",
     *     tags={"Companies search"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/SearchInRadius"),
     *          ),
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     security={{"bearerAuth":{}}},
     * )
     */
    public function searchInRadius(SearchInRadiusRequest $request): JsonResponse
    {
        $dto = SearchInRadiusDto::from($request->validated());
        return new JsonResponse([
            'data' => $this->radiusSearchScenario->handle($dto)
        ]);
    }

    /**
     * @param SearchByActivityTitleRequest $request
     * @return JsonResponse
     * @OA\Post(
     *      path="/api/company/search/activity/title",
     *      summary="Search companies by activity title",
     *      tags={"Companies search"},
     *      @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/SearchByActivityTitle"),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      ),
     *     security={{"bearerAuth":{}}},
     *  )
     */
    public function searchByActivityTitle(SearchByActivityTitleRequest $request): JsonResponse
    {
        $dto = SearchByActivityTitleDto::from($request->validated());

        return new JsonResponse([
            'data' => $this->activityTitleSearchScenario->handle($dto)
        ]);
    }

    /**
     * @param SearchByTitleRequest $request
     * @return JsonResponse
     * @OA\Post(
     *      path="/api/company/search/title",
     *      summary="Search companies by title",
     *      tags={"Companies search"},
     *      @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(ref="#/components/schemas/SearchByTitle"),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="OK"
     *      ),
     *     security={{"bearerAuth":{}}},
     *  )
     */
    public function searchByTitle(SearchByTitleRequest $request): JsonResponse
    {
        $dto = SearchByTitleDto::from($request->validated());
        return new JsonResponse([
            'data' => $this->searchByTitleScenario->handle($dto)
        ]);
    }
}
