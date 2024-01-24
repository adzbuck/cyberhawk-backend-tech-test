<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class User extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = ['name', 'email'];
}
