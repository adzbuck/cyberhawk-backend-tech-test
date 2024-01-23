<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "Wind farm API", title: "Wind farm API Documentation"),
]
abstract class Controller extends BaseController
{
    use AuthorizesRequests;
}
