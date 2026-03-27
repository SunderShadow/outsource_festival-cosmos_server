<?php

namespace App\Orchid\Layouts\Restaurants\Meal;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class MealEditTextLayout extends Rows
{
    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Input::make('meal.name')
                ->title(__('Название сета'))
                ->placeholder('Спагетти с сыром')
                ->required(),
            Input::make('meal.chef_name')
                ->title(__('Шеф-повар'))
                ->value($this->query['restaurant']->chef_name)
                ->placeholder('Спагетти с сыром')
                ->required(),
            Input::make('meal.cost')
                ->title(__('Стоимость ($)'))
                ->type('text')
                ->mask([
                    'alias' => 'currency',
                    'prefix' => '$ ',        // Change to your currency symbol
                    'groupSeparator' => ',', // Thousands separator
                    'digits' => 2,           // Decimal places
                    'digitsOptional' => false,
                    'rightAlign' => false,
                ])
                ->required()
                ->placeholder(__('$ 0.00'))
        ];
    }
}
