<?php

namespace App\Orchid\Layouts\Restaurants\Meal;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Cropper;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Layouts\Rows;

class MealEditImageLayout extends Rows
{

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): iterable
    {
        return [
            Group::make([
                Cropper::make('meal.thumbnail')
                    ->title(__('Изображение'))
                    ->width(1000)
                    ->height(1000)
                    ->accept('image/*')
                    ->required()
                    ->targetRelativeUrl(),
                Cropper::make('meal.card_thumbnail')
                    ->title(__('Изображение карточки'))
                    ->width(150)
                    ->height(150)
                    ->accept('image/*')
                    ->required()
                    ->targetRelativeUrl(),
            ])
        ];
    }
}
