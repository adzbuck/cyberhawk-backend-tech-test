<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(
    description: "List turbines",
    properties: [
        new OA\Property(
            property: 'data',
            description: 'Array of all turbine data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/TurbineResource'
            )
        ),
    ],
    type: 'object'
)]
class TurbineCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }
}
