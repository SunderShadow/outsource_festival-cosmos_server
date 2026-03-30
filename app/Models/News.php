<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

/**
 * @property int $id
 * @property string|null $thumbnail_mobile
 * @property string|null $thumbnail_desktop
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property array<array-key, mixed>|null $social_links [{href: string, icon: string}]
 * @property string $body Основной контент
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $published
 * @property-read mixed $thumbnails
 * @method static Builder<static>|News newModelQuery()
 * @method static Builder<static>|News newQuery()
 * @method static Builder<static>|News published()
 * @method static Builder<static>|News query()
 * @method static Builder<static>|News whereBody($value)
 * @method static Builder<static>|News whereCreatedAt($value)
 * @method static Builder<static>|News whereExcerpt($value)
 * @method static Builder<static>|News whereId($value)
 * @method static Builder<static>|News wherePublished($value)
 * @method static Builder<static>|News whereSlug($value)
 * @method static Builder<static>|News whereSocialLinks($value)
 * @method static Builder<static>|News whereThumbnailDesktop($value)
 * @method static Builder<static>|News whereThumbnailMobile($value)
 * @method static Builder<static>|News whereTitle($value)
 * @method static Builder<static>|News whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class News extends Model
{
    use AsSource;

    protected $guarded = ['id'];

    protected $hidden = [
        'thumbnail_desktop',
        'thumbnail_mobile',
    ];

    protected $appends = [
        'thumbnails',
    ];

    protected function casts()
    {
        return [
            'social_links' => 'array'
        ];
    }

    protected static function booted()
    {
        parent::booted();

        // Update slug before save
        static::saving(function ($news) {
            $news->slug = str()->slug($news->title);
        });

        // Set slug before create
        static::creating(function ($news) {
            $news->slug = str()->slug($news->title);
        });
    }

    #[Scope]
    protected function published(Builder $query): void
    {
        $query->where('published', 1);
    }

    public function thumbnails(): Attribute
    {
        return Attribute::get(fn ($v) => [
            'desktop' => config('app.url') . $this->thumbnail_desktop,
            'mobile' => config('app.url') . $this->thumbnail_mobile
        ]);
    }
}
