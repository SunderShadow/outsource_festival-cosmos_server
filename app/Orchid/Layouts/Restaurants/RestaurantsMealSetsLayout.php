<?php

namespace App\Orchid\Layouts\Restaurants;

use App\Models\Restaurant;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class RestaurantsMealSetsLayout extends Table
{
    protected $target = 'restaurant.meal';

    protected function columns(): iterable
    {
        return [
            TD::make(__('<UNK>'))
        ];
    }
}
