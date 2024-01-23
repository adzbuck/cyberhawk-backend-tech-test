<?php

namespace App\Repository\Eloquent;

use App\Models\Turbine;
use App\Repository\TurbineRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseRepository<Turbine>
 * @property Turbine $model
 */
class TurbineRepository extends BaseRepository implements TurbineRepositoryInterface
{
    public function __construct(Turbine $model)
    {
        parent::__construct($model);
    }

    public function fetchAllByFarmId(int $farmId): Collection
    {
        return $this->model
            ->where('farm_id', $farmId)
            ->get();
    }

    public function fetchByIdFilteredByFarmId(int $id, int $farmId): ?Model
    {
        /** @var ?Turbine $turbine */
        $turbine = $this->model
            ->where('farm_id', $farmId)
            ->find($id);

        return $turbine;
    }
}
