<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string $thumbnail_mobile
 * @property string $thumbnail_desktop
 * @property string $thumbnail_card
 * @property string $slug
 * @property string $title
 * @property string $phone
 * @property string|null $chef_name
 * @property string|null $min_cost
 * @property string $location
 * @property string $map_link Example: https://some.external/site
 * @property string $external_website_link Example: https://some.external/site
 * @property string $description
 * @property string $open_time Format: HH:mm
 * @property string $close_time Format: HH:mm
 * @property int $rating_atmosphere
 * @property int $rating_taste
 * @property int $rating_serving
 * @property int $rating_service
 * @property int $verified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $published
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Meal> $meals
 * @property-read int|null $meals_count
 * @property-read mixed $rating
 * @property-read mixed $thumbnails
 * @property-read mixed $working_time
 * @method static Builder<static>|Restaurant newModelQuery()
 * @method static Builder<static>|Restaurant newQuery()
 * @method static Builder<static>|Restaurant published()
 * @method static Builder<static>|Restaurant query()
 * @method static Builder<static>|Restaurant whereChefName($value)
 * @method static Builder<static>|Restaurant whereCloseTime($value)
 * @method static Builder<static>|Restaurant whereCreatedAt($value)
 * @method static Builder<static>|Restaurant whereDescription($value)
 * @method static Builder<static>|Restaurant whereExternalWebsiteLink($value)
 * @method static Builder<static>|Restaurant whereId($value)
 * @method static Builder<static>|Restaurant whereLocation($value)
 * @method static Builder<static>|Restaurant whereMapLink($value)
 * @method static Builder<static>|Restaurant whereMinCost($value)
 * @method static Builder<static>|Restaurant whereOpenTime($value)
 * @method static Builder<static>|Restaurant wherePhone($value)
 * @method static Builder<static>|Restaurant wherePublished($value)
 * @method static Builder<static>|Restaurant whereRatingAtmosphere($value)
 * @method static Builder<static>|Restaurant whereRatingService($value)
 * @method static Builder<static>|Restaurant whereRatingServing($value)
 * @method static Builder<static>|Restaurant whereRatingTaste($value)
 * @method static Builder<static>|Restaurant whereSlug($value)
 * @method static Builder<static>|Restaurant whereThumbnailCard($value)
 * @method static Builder<static>|Restaurant whereThumbnailDesktop($value)
 * @method static Builder<static>|Restaurant whereThumbnailMobile($value)
 * @method static Builder<static>|Restaurant whereTitle($value)
 * @method static Builder<static>|Restaurant whereUpdatedAt($value)
 * @method static Builder<static>|Restaurant whereVerified($value)
 * @property string|null $city
 * @property string|null $thumbnail_chef
 * @method static Builder<static>|Restaurant whereCity($value)
 * @method static Builder<static>|Restaurant whereThumbnailChef($value)
 * @mixin \Eloquent
 */
class Restaurant extends Model
{
    use AsSource;

    protected $hidden = [
        'thumbnail_desktop',
        'thumbnail_mobile',
        'rating_atmosphere',
        'rating_taste',
        'rating_serving',
        'rating_service',
        'open_time',
        'close_time',
    ];

    protected $appends = [
        'thumbnails',
        'rating',
        'working_time'
    ];

    protected static function booted()
    {
        parent::booted();

        // Update slug before save
        static::saving(function ($restaurant) {
            $restaurant->slug = str()->slug($restaurant->title);
        });

        // Set slug before create
        static::creating(function ($restaurant) {
            $restaurant->slug = str()->slug($restaurant->title);
        });
    }

    protected $guarded = ['id'];

    public function meals(): HasMany
    {
        return $this->hasMany(Meal::class);
    }

    public function thumbnails(): Attribute
    {
        return Attribute::get(fn ($v) => [
            'desktop' => config('app.url') . $this->thumbnail_desktop,
            'mobile' => config('app.url') . $this->thumbnail_mobile,
            'card' => config('app.url') . $this->thumbnail_card,
            'chef' => config('app.url') . $this->thumbnail_chef
        ]);
    }

    public function rating(): Attribute
    {
        return Attribute::get(fn ($v) => [
            'atmosphere' => $this->rating_atmosphere,
            'taste' => $this->rating_taste,
            'serving' => $this->rating_serving,
            'service' => $this->rating_service
        ]);
    }

    public function workingTime(): Attribute
    {
        return Attribute::get(fn ($v) => [
            'open_at' => $this->open_time,
            'close_at' => $this->close_time,
        ]);
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('published', 1);
    }
}
