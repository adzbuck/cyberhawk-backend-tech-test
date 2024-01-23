<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Components(
    responses: [
        new OA\Response(
            response: "InternalServerError",
            description: "Internal Server Error"
        )
    ]
)]
class OpenApiComponents
{
}
