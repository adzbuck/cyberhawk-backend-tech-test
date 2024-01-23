<?php

namespace App\Http\Controllers;

use App\Http\Resources\FarmCollection;
use App\Http\Resources\FarmResource;
use App\Services\FarmService;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;

class FarmController extends Controller
{
    private FarmService $farmService;

    public function __construct(FarmService $farmService)
    {
        $this->farmService = $farmService;
    }

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
    public function index(): FarmCollection
    {
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
        $farm = $this->farmService->fetchById((int) $farmID);

        if (!$farm) {
            abort(404);
        }

        return new FarmResource($farm);
    }
}