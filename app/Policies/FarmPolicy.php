<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FarmPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list all farms
     *
     * @param User $user
     * @return bool
     */
    public function list(User $user): bool
    {
        return $user->tokenCan('server:list-farms');
    }

    /**
     * Determine whether the user can view individual farms
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->tokenCan('server:view-farm');
    }
}
