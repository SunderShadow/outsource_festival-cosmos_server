<?php

namespace App\Orchid\Layouts\Restaurants;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Range;
use Orchid\Screen\Layouts\Rows;

class RestaurantsEditRatingInfo extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('restaurant.rating_atmosphere')
                ->title('Атмосфера ресторана')
                ->type('range')
                ->min(0)
                ->max(10)
                ->step(1),
            Input::make('restaurant.rating_taste')
                ->title('Вкус сета')
                ->type('range')
                ->min(0)
                ->max(10),
            Input::make('restaurant.rating_serving')
                ->title('Подача')
                ->type('range')
                ->min(0)
                ->max(10),
            Input::make('restaurant.rating_service')
                ->title('Обслуживание')
                ->type('range')
                ->min(0)
                ->max(10),
        ];
    }
}
