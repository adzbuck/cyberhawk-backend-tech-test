<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
#[OA\Schema(
    description: "Show farm details",
    properties: [
        new OA\Property(
            property: 'id',
            description: 'ID of the farm',
            type: 'integer',
            example: 4,
        ),
        new OA\Property(
            property: 'name',
            description: 'Name of the farm',
            type: 'integer',
            example: 'Sample Farm',
        ),
        new OA\Property(
            property: 'createdAt',
            description: 'The datetime the farm was created',
            type: 'date-time',
            example: '2024-01-23T12:00:20.000000Z',
        ),
        new OA\Property(
            property: 'updatedAt',
            description: 'The datetime the farm was created',
            type: 'date-time',
            example: '2024-01-23T12:00:20.000000Z',
        ),
    ],
    type: 'object'
)]
class FarmResource extends JsonResource
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
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
