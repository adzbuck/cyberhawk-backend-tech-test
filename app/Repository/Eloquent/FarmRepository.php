<?php

namespace App\Repository\Eloquent;

use App\Models\Farm;
use App\Repository\FarmRepositoryInterface;

/**
 * @extends BaseRepository<Farm>
 * @property Farm $model
 */
class FarmRepository extends BaseRepository implements FarmRepositoryInterface
{
    public function __construct(Farm $model)
    {
        parent::__construct($model);
    }
}
