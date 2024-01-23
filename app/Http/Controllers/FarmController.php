<?php

namespace App\Http\Controllers;

use App\Http\Resources\FarmCollection;
use App\Http\Resources\FarmResource;
use App\Models\Farm;
use App\Services\FarmService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class FarmController extends Controller
{
    private FarmService $farmService;

    public function __construct(FarmService $farmService)
    {
        $this->farmService = $farmService;
    }

    /**
     * @throws AuthorizationException
     */
    #[OA\Get(
        path: "/api/farms",
        summary: "List all farm details",
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "OK",
                content: new OA\JsonContent(
                    ref: '#/components/schemas/FarmCollection',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    public function index(Request $request): FarmCollection
    {
        $this->authorize('list', Farm::class);

        $farms = $this->farmService->fetchAll();

        return new FarmCollection($farms);
    }

    #[OA\Get(
        path: "/api/farms/{farmId}",
        summary: "Show farm details",
        parameters: [
            new OA\Parameter(
                name: 'farmId',
                description: 'The ID of the farm',
                in: 'path',
                required: true,
                example: 5,
            )
        ],
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "OK",
                content: new OA\JsonContent(
                    ref: '#/components/schemas/FarmResource',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    public function show(string $farmID): FarmResource
    {
        $this->authorize('view', Farm::class);

        $farm = $this->farmService->fetchById((int) $farmID);

        if (!$farm) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return new FarmResource($farm);
    }
}
