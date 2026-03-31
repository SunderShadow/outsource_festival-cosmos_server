<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers query()
 * @mixin \Eloquent
 */
class ContestUsers extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];
}
