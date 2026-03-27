<?php

namespace App\Orchid\Layouts\Restaurants\Meal;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class MealEditDescription extends Rows
{
    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            TextArea::make('meal.description')
                ->title(__('Описание'))
                ->rows(5)
                ->required()
        ];
    }
}
