<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TurbinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can list all turbines
     *
     * @param User $user
     * @return bool
     */
    public function list(User $user): bool
    {
        return $user->tokenCan('server:list-turbine');
    }

    /**
     * Determine whether the user can view individual turbine
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->tokenCan('server:view-turbine');
    }
}
