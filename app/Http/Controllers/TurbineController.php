<?php

namespace App\Http\Controllers;

use App\Http\Resources\TurbineCollection;
use App\Http\Resources\TurbineResource;
use App\Models\Turbine;
use App\Services\FarmService;
use App\Services\TurbineService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class TurbineController extends Controller
{
    private FarmService $farmService;
    private TurbineService $turbineService;

    public function __construct(
        FarmService $farmService,
        TurbineService $turbineService,
    ) {
        $this->farmService = $farmService;
        $this->turbineService = $turbineService;
    }

    #[OA\Get(
        path: "/api/turbines",
        summary: "List all turbines",
        responses: [
            new OA\Response(
                response: Response::HTTP_OK,
                description: "OK",
                content: new OA\JsonContent(
                    ref: '#/components/schemas/TurbineCollection',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    #[OA\Get(
        path: "/api/farms/{farmId}/turbines",
        summary: "List all turbines for a specific farm",
        parameters: [
            new OA\Parameter(
                name: 'farmId',
                description: 'The ID of the farm to filter by',
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
                    ref: '#/components/schemas/TurbineCollection',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    public function index(Request $request): TurbineCollection
    {
        $this->authorize('list', Turbine::class);

        $farmId = (int) $request->route('farmId');

        if ($farmId && !$this->farmService->fetchById($farmId)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $turbines = match(true) {
            !!$farmId => $this->turbineService->fetchAllByFarmId($farmId),
            default => $this->turbineService->fetchAll(),
        };

        return new TurbineCollection($turbines);
    }

    #[OA\Get(
        path: "/api/turbines/{turbineId}",
        summary: "Show turbine details",
        parameters: [
            new OA\Parameter(
                name: 'turbineId',
                description: 'The ID of the turbine',
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
                    ref: '#/components/schemas/TurbineResource',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    #[OA\Get(
        path: "/api/farms/{farmId}/turbines/{turbineId}",
        summary: "Show turbine details related to a specific farm",
        parameters: [
            new OA\Parameter(
                name: 'farmId',
                description: 'The ID of the farm to filter by',
                in: 'path',
                required: true,
                example: 5,
            ),
            new OA\Parameter(
                name: 'turbineId',
                description: 'The ID of the turbine',
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
                    ref: '#/components/schemas/TurbineResource',
                ),
            ),
            new OA\Response(
                ref: '#/components/responses/InternalServerError',
                response: Response::HTTP_INTERNAL_SERVER_ERROR,
            )
        ]
    )]
    public function show(Request $request): TurbineResource
    {
        $this->authorize('view', Turbine::class);

        $farmId = (int) $request->route('farmId');
        $turbineId = (int) $request->route('turbineId');

        if ($farmId && !$this->farmService->fetchById($farmId)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $turbine = match(true) {
            !!$farmId => $this->turbineService->fetchByIdFilteredByFarmId($turbineId, $farmId),
            default => $this->turbineService->fetchById($turbineId),
        };

        if (!$turbine) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return new TurbineResource($turbine);
    }
}
