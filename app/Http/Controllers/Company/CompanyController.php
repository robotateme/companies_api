<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Building;
use App\Services\Company\Scenarios\GetByActivityScenario;
use App\Services\Company\Scenarios\GetByBuildingScenario;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    public function __construct(
        private readonly GetByBuildingScenario $getByBuildingScenario,
        private readonly GetByActivityScenario $getByActivityScenario
    )
    {
    }

    /**
     * @param Activity $activity
     * @return JsonResponse
     * @OA\Get(
     *     path="/api/company/activity/{id}",
     *     summary="Список компаний по роду деятельности",
     *     tags={"Companies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="activity ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             example="1"
     *         ),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Положительный ответ на запрос",
     *          @OA\JsonContent(
     *               type="array",
     *               @OA\Items(
     *                   @OA\Property(
     *                       property="data",
     *                       ref="#/components/schemas/CompanyResult",
     *                   ),
     *               )
     *           )
     *      ),
     *     ),
     *     security={{"bearerAuth":{}}},
     * )
     *
     */
    public function getByActivity(Activity $activity): JsonResponse
    {
        return new  JsonResponse([
            'data' => $this->getByActivityScenario->handle($activity->id)
        ]);
    }

    /**
     * @param Building $building
     * @return JsonResponse
     * @OA\Get(
     *     path="/api/company/building/{id}",
     *     summary="Список компаний по роду деятельности",
     *     tags={"Companies"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="building ID",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *              example="1"
     *         ),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Положительный ответ на запрос",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(
     *                      property="data",
     *                      ref="#/components/schemas/CompanyResult",
     *                  ),
     *              )
     *          )
     *     ),
     *     security={{"bearerAuth":{}}},
     * )
     *
     */
    public function getByBuilding(Building $building): JsonResponse
    {
        return new JsonResponse([
            'data' => $this->getByBuildingScenario->handle($building->id)
        ]);
    }
}
