<?php

namespace App\Services;

use App\Models\Turbine;
use App\Repository\TurbineRepositoryInterface;
use Illuminate\Support\Collection;

class TurbineService
{
    private TurbineRepositoryInterface $turbineRepository;

    public function __construct(TurbineRepositoryInterface $turbineRepository)
    {
        $this->turbineRepository = $turbineRepository;
    }

    /**
     * @return Collection<int, Turbine>
     */
    public function fetchAll(): Collection
    {
        return $this->turbineRepository->fetchAll();
    }

    public function fetchById(int $turbineId): ?Turbine
    {
        return $this->turbineRepository->fetchById($turbineId);
    }

    /**
     * @return Collection<int, Turbine>
     */
    public function fetchAllByFarmId(int $farmId): Collection
    {
        return $this->turbineRepository->fetchAllByFarmId($farmId);
    }

    public function fetchByIdFilteredByFarmId(int $turbineId, int $farmId): ?Turbine
    {
        return $this->turbineRepository->fetchByIdFilteredByFarmId($turbineId, $farmId);
    }
}
