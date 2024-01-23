<?php

namespace App\Repository\Eloquent;

use App\Models\Farm;
use App\Repository\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @template T
 * @implements BaseRepositoryInterface<Farm>
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function fetchAll(): Collection
    {
        return $this->model->all();
    }

    public function fetchById(int $id): ?Model
    {
        return $this->model->find($id);
    }
}
