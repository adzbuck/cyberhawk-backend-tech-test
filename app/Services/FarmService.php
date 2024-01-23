<?php

namespace App\Services;

use App\Models\Farm;
use App\Repository\FarmRepositoryInterface;
use Illuminate\Support\Collection;

class FarmService
{
    private FarmRepositoryInterface $farmRepository;

    public function __construct(FarmRepositoryInterface $farmRepository)
    {
        $this->farmRepository = $farmRepository;
    }

    /**
     * @return Collection<int, Farm>
     */
    public function fetchAll(): Collection
    {
        return $this->farmRepository->fetchAll();
    }

    public function fetchById(int $farmId): ?Farm
    {
        return $this->farmRepository->fetchById($farmId);
    }
}
