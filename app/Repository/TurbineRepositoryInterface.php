<?php

namespace App\Repository;

use App\Models\Turbine;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends BaseRepositoryInterface<Turbine>
 */
interface TurbineRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @return Collection<int, Turbine>
     */
    public function fetchAllByFarmId(int $farmId): Collection;

    /**
     * @return Turbine|null
     */
    public function fetchByIdFilteredByFarmId(int $id, int $farmId): ?Model;
}
