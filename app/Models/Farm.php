<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property string $name
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class Farm extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
}
