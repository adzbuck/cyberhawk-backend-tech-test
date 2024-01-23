<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[
    OA\Info(version: "1.0.0", description: "Wind farm API", title: "Wind farm API Documentation"),
]
abstract class Controller
{
}
