<?php

namespace App\Orchid\Layouts\Restaurants;

use App\Models\Restaurant;
use Orchid\Screen\Actions\Menu;
use Orchid\Screen\Layouts\TabMenu;

class RestaurantNavigation extends TabMenu
{
    /**
     * Get the menu elements to be displayed.
     *
     * @return Menu[]
     */
    protected function navigations(): iterable
    {
        /** @var Restaurant $restaurant */
        $restaurant = $this->query['restaurant'];

        $currentPathURL = config('app.url') . '/' . request()->path();
        $homePathURL = route('platform.restaurants.edit', ['restaurant' => $restaurant->id]);

        $menu = [
            Menu::make(__('Основная информация'))
                ->route('platform.restaurants.edit', ['restaurant' => $restaurant->id]),
            Menu::make('Сеты')
                ->route('platform.restaurants.meal', ['restaurant' => $restaurant->id])
        ];

        if ($currentPathURL !== $homePathURL) {
            $menu[0]->active(false);
        }

        return $menu;
    }
}
