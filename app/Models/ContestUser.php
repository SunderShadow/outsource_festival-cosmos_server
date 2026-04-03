<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser query()
 * @property int $id
 * @property string $uid Not uuid
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $review
 * @property int $restaurant_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUser whereUid($value)
 * @mixin \Eloquent
 */
class ContestUser extends Model
{
    use AsSource;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
