<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers query()
 * @property int $id
 * @property string $uid Not uuid
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $review
 * @property int $restaurant_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers whereUid($value)
 * @mixin \Eloquent
 */
class ContestUsers extends Model
{
    public $timestamps = false;

    protected $guarded = ['id'];
}
