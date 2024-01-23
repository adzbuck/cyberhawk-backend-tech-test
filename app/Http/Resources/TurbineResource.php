<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @property int $id
 * @property int $farm_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
#[OA\Schema(
    description: "Show turbine details",
    properties: [
        new OA\Property(
            property: 'id',
            description: 'ID of the turbine',
            type: 'integer',
            example: 4,
        ),
        new OA\Property(
            property: 'farm_id',
            description: 'ID of the parent farm',
            type: 'integer',
            example: 3,
        ),
        new OA\Property(
            property: 'name',
            description: 'Name of the turbine',
            type: 'integer',
            example: 'Sample Turbine',
        ),
        new OA\Property(
            property: 'created_at',
            description: 'The datetime the turbine was created',
            type: 'string',
            format: 'date-time',
            example: '2024-01-23T12:00:20.000000Z',
        ),
        new OA\Property(
            property: 'updated_at',
            description: 'The datetime the turbine was created',
            type: 'string',
            format: 'date-time',
            example: '2024-01-23T12:00:20.000000Z',
        ),
    ],
    type: 'object'
)]
class TurbineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'farm_id' => $this->farm_id,
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
