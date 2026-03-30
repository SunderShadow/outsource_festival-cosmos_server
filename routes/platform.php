<?php

declare(strict_types=1);

use App\Orchid\Screens\News\NewsCreateScreen;
use App\Orchid\Screens\News\NewsEditScreen;
use App\Orchid\Screens\News\NewsListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Restaurants\Meal\CreateMealScreen;
use App\Orchid\Screens\Restaurants\Meal\EditMealScreen;
use App\Orchid\Screens\Restaurants\Meal\ListMealScreen;
use App\Orchid\Screens\Restaurants\RestaurantsCreateScreen;
use App\Orchid\Screens\Restaurants\RestaurantsEditScreen;
use App\Orchid\Screens\Restaurants\RestaurantsListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > News > List
Route::screen('/news', NewsListScreen::class)
    ->name('platform.news');

// Platform > News > Create
Route::screen('/news/create', NewsCreateScreen::class)
    ->name('platform.news.create');

// Platform > News > Edit
Route::screen('/news/edit/{news}', NewsEditScreen::class)
    ->name('platform.news.edit');

// Platform > Restaurants > List
Route::prefix('/restaurants')->name('platform.restaurants')->group(static function () {
    Route::screen('/', RestaurantsListScreen::class);

    // Platform > Restaurants > Create
    Route::screen('/create', RestaurantsCreateScreen::class)
        ->name('.create')
        ->breadcrumbs(function (Trail $trail) {
            return $trail
                ->push('Рестораны', route('platform.restaurants'))
                ->push('Создать', route('platform.restaurants.create'));
        });;

    Route::prefix('/edit/{restaurant}/')->name('.edit')->group(static function () {
        // Platform > Restaurants > Edit
        Route::screen('/', RestaurantsEditScreen::class)
            ->breadcrumbs(function (Trail $trail, $restaurant) {
                return $trail
                    ->push('Рестораны', route('platform.restaurants'))
                    ->push($restaurant->title, route('platform.restaurants.edit', $restaurant))
                    ->push('Редактировать', route('platform.restaurants.edit', $restaurant));
            });
    });

    Route::prefix('/{restaurant}/meal')->name('.meal')->group(static function () {

        // Platform > Restaurants > Meal
        Route::screen('/', ListMealScreen::class)
            ->breadcrumbs(function (Trail $trail, $restaurant) {
                return $trail
                    ->push('Рестораны', route('platform.restaurants'))
                    ->push($restaurant->title, route('platform.restaurants.edit', $restaurant))
                    ->push('Сеты', route('platform.restaurants.meal', $restaurant));
            });

        // Platform > Restaurants > Meal > Edit
        Route::screen('/add', CreateMealScreen::class)
            ->name('.create')
            ->breadcrumbs(function (Trail $trail, $restaurant) {
                return $trail
                    ->parent('platform.restaurants.meal', $restaurant)
                    ->push('Добавить', route('platform.restaurants.meal.create', $restaurant));
            });

        // Platform > Restaurants > Meal > Create
        Route::screen('/{meal}/edit', EditMealScreen::class)
            ->name('.edit')
            ->breadcrumbs(function (Trail $trail, $restaurant, $meal) {
                return $trail
                    ->parent('platform.restaurants.meal', $restaurant)
                    ->push('Редактировать', route('platform.restaurants.meal.edit', ['meal' => $meal, 'restaurant' => $restaurant]));
            });
    });
});

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Route::screen('idea', Idea::class, 'platform.screens.idea');
