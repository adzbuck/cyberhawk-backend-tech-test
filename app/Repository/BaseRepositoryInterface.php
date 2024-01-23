<?php

namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface BaseRepositoryInterface
{
    /**
     * @return Collection<int, T>
     */
    public function fetchAll(): Collection;

    /**
     * @return T|null
     */
    public function fetchById(int $id): ?Model;
}
