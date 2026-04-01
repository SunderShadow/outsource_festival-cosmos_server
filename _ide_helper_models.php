<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ContestUsers query()
 * @mixin \Eloquent
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
 */
	class ContestUsers extends \Eloquent {}
}

namespace App\Models{
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
	class Meal extends \Eloquent {}
}

namespace App\Models{
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
	class News extends \Eloquent {}
}

namespace App\Models{
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
 * @mixin \Eloquent
 * @property string|null $city
 * @property string|null $thumbnail_chef
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Restaurant whereThumbnailChef($value)
 */
	class Restaurant extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property array<array-key, mixed>|null $permissions
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Orchid\Platform\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User averageByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User byAccess(string $permitWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User byAnyAccess($permitsWithoutWildcard)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User countByDays($startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User countForGroup(string $groupColumn)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User defaultSort(string $column, string $direction = 'asc')
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User filters(?mixed $kit = null, ?\Orchid\Filters\HttpFilter $httpFilter = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User filtersApply(iterable $filters = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User filtersApplySelection($class)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User maxByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User minByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User sumByDays(string $value, $startDate = null, $stopDate = null, ?string $dateColumn = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User valuesByDays(string $value, $startDate = null, $stopDate = null, string $dateColumn = 'created_at')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePermissions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

