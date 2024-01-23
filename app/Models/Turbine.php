<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property int $farmId
 * @property string $name
 * @property Carbon $createdAt
 * @property Carbon $updatedAt
 */
class Turbine extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
