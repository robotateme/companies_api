<?php

namespace App\Http\Controllers;
/**
 * @OA\Info(
 *       version="1.0.0",
 *       title="Laravel OpenApi Demo Documentation",
 *       description="L5 Swagger OpenApi description",
 *       @OA\Contact(
 *           email="jarwork884@gmail.com"
 *       ),
 *       @OA\License(
 *           name="Apache 2.0",
 *           url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *       )
 *  )
 * @OA\Components(
 *        @OA\SecurityScheme(
 *            name="Bearer Authentication",
 *            securityScheme="bearerAuth",
 *            type="http",
 *            scheme="bearer",
 *            bearerFormat="JWT"
 *        ),
 *        @OA\Attachable
 * )
 */
abstract class Controller
{
    //
}
