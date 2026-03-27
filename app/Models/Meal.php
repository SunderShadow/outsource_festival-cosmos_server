<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo as BelongsToAlias;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $thumbnail
 * @property string|null $card_thumbnail
 * @property string|null $chef_name
 * @property int $cost
 * @property int $restaurant_id
 * @property-read Meal|null $meal
 * @property-read mixed $thumbnails
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereCardThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereChefName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereRestaurantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Meal whereThumbnail($value)
 * @mixin \Eloquent
 */
class Meal extends Model
{
    use AsSource;

    protected $guarded = ['id'];
    public $timestamps = false;

    protected $hidden = [
        'thumbnail',
        'card_thumbnail'
    ];

    protected $appends = [
        'thumbnails'
    ];

    public function meal(): BelongsToAlias
    {
        return $this->belongsTo(Meal::class);
    }

    public function thumbnails(): Attribute
    {
        return Attribute::get(fn ($v) => [
            'full' => config('app.url') . $this->thumbnail,
            'card' => config('app.url') . $this->card_thumbnail
        ]);
    }
}
